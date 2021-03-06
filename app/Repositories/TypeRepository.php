<?php

namespace App\Repositories;

use App\Category;
use App\City;
use App\Type;

class TypeRepository extends BaseRepository
{
    protected $searchFields = ['name'];

    /**
     * TypeRepository constructor.
     */
    public function __construct()
    {
        $this->model = \App\Type::class;
    }

    /**
     * Get entities list
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function all()
    {
        $user = auth()->user();
        $q = Type::orderBy('order');

        if ($user->isAdmin()) {
            $cities = empty($user->cities) ? [] : City::whereIn('id', $user->cities)->pluck('id');
            $q->whereIn('city_id', $cities);
        }

        $q = $this->search($q);

        return $q;
    }

    /**
     * Save entity
     *
     * @param array $data
     * @param null $id
     * @return mixed
     */
    public function save(array $data, $id = null)
    {
        $entity = $this->findOrNew($id);
        $entity->name = $data['name'];
        $entity->slug  = str_slug($data['name']);
        $entity->city_id  = (int) $data['city_id'];
        $entity->category_id  = (int) $data['category_id'];
        $entity->is_active = !empty($data['is_active']);
        $entity->order = $data['order'];
        $entity->color = $data['color'];

        if (!empty($data['icon'])) {
        $file = $this->uploadFile('icon', 'types');
            $entity->icon = $file;
        }

        $entity->save();

        return $entity;
    }

    /**
     * Get all active types for category
     *
     * @param $categoryId
     * @return \Illuminate\Support\Collection
     */
    public function allActiveForCategory($categoryId)
    {
        $data = Type::where('category_id', $categoryId)->where('is_active', true)->orderBy('order')->get();

        return \App\Http\Resources\Type::collection($data);
    }

    public function findByCityCategoryAndSlugOrCreate(City $city, Category $category, array $data)
    {
        $slug = $data['slug'];

        $entity = Type::orderBy('order')
            ->where('city_id', $city->id)
            ->where('category_id', $category->id)
            ->where('slug', $slug)
            ->first();

        if (! $entity) {
            return $this->save($data);
        }

        return $entity;
    }
}