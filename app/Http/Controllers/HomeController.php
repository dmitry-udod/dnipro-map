<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\Structure;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\StructureRepository;
use App\Repositories\TypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * @property StructureRepository repository
 */
class HomeController extends Controller
{
    public function __construct(StructureRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the map
     *
     * @return \Illuminate\Http\Response
     */
    public function index($citySlug, $category = null)
    {
        $cityRepository = new CityRepository();

        if (!$citySlug) {
            $cities = $cityRepository->allActiveOrderByName();
            return view('select_city', compact('cities'));
        }

        $city = $cityRepository->findBySlug($citySlug);

        $viewName = 'welcome';
        $filters = ['type_ids' => request('types'), 'search' => request('q')];
        $entities = Structure::collection($this->repository->allByCityAndCategory($city, $category, $filters));
        $types = $entities->isEmpty() ? new Collection()  : (new TypeRepository)->allActiveForCategory($entities[0]->category_id);
        $category = (new CategoryRepository())->findBySlug($city, $category);

        if (! $category && ! $entities->isEmpty()) {
            $category = (new CategoryRepository())->find($entities[0]->category_id);
        }

        if (request()->routeIs('main_list')) {
            $viewName = 'list';
        }

        return view($viewName, compact('entities', 'types', 'category'));
    }
}
