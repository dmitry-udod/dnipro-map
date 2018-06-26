<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\City;
use App\Http\Controllers\Traits\JsonHelpers;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\StructureRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserRepository;
use App\User;

class ImportController extends BaseAdminController
{
    use JsonHelpers;

    public function __construct(UserRepository $repository)
    {
        $this->model = User::class;
        $this->repository = $repository;
        parent::__construct();
    }

    /**
     * Show import form
     *
     * @return \Response
     */
    public function index()
    {
        $cities = (new CityRepository)->allActiveOrderByName();
        $categories = (new CategoryRepository())->allActiveOrderByName();

        return view('admin.import.index', compact('cities', 'categories'));
    }

    /**
     * Process imported data and create new structures
     *
     * @return \Response
     */
    public function saveData()
    {
        $cityId = request('city_id');
        $categoryId = request('category_id');
        $data = request('data');
        $typeRepository = new TypeRepository();
        $structuresRepository = new StructureRepository();
        $city = City::findOrFail($cityId);
        $category = Category::findOrFail($categoryId);
        $newStructuresCounter = 0;

        $structures = [];

        foreach ($data as $index => $row) {

            foreach ($row['data'] as $columnsIndex => $column) {
                if ($columnsIndex > 0) {
                    $column = preg_replace('/\s+/', ' ', $column);
                    // Coordinates
                    if ($row['column'] === 'coordinates') {
                        $latLang = array_map('trim', explode(',', $column));
                        if (count($latLang) > 1) {
                            $structures[$columnsIndex]['latitude'] = $latLang[0];
                            $structures[$columnsIndex]['longitude'] = $latLang[1];
                        } else {
                            return $this->jsonError("Помилка в координатах для структури #$index; $column", 500);
                        }
                    }
                    // Type ID
                    else if($row['column'] === 'type') {
                        $type = $typeRepository->findByCityCategoryAndSlugOrCreate($city, $category, [
                            'name' => $column,
                            'slug' => str_slug($column),
                            'city_id' => $city->id,
                            'category_id' => $category->id,
                            'is_active' => true,
                            'color' => '#ffffff',
                            'order' => '0',
                        ]);
                        $structures[$columnsIndex]['type_id'] = $type->id;
                    } else  if (starts_with($row['column'], 'custom_')) {
                        $id = str_replace('custom_', '', $row['column']);
                        $structures[$columnsIndex]['additional_fields'][] = [
                            'id' => $id,
                            'name' => $row['data'][$columnsIndex],
                            'value' => $column,
                        ];

                    } else {
                        $structures[$columnsIndex][$row['column']] = $column;
                    }
                }
            }
        }

        if (!empty($structures)) {
            foreach ($structures as $structure) {
                $structure['is_active'] = true;
                $structure['city_id'] = $cityId;
                $structure['category_id'] = $categoryId;
                $isSaved = $structuresRepository->save($structure);
                if (! $isSaved) {
                    logger()->error("Cant save import structure", [$isSaved, $structure]);
                    return $this->jsonError("Помилка при збереженнi. Адреса: {$structure['address']}", 500);
                }
                $newStructuresCounter++;
            }
        }

        return $this->jsonMessage("Додано $newStructuresCounter нових oб'єктiв");
    }
}
