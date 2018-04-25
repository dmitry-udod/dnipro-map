<?php

namespace App\Repositories;

use App\City;

class StructureRepository extends BaseRepository
{
    /**
     * Get entities list
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function all()
    {
        $user = auth()->user();
        $q = $this->model::orderBy('name');

        if ($user->isAdmin()) {
            $cities = empty($user->cities) ? [] : City::whereIn('id', $user->cities)->pluck('id');
            $q->whereIn('city_id', $cities);
        }

        return $q;
    }

    /**
     * Save entity
     *
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function save(array $data, $id = null)
    {
        $entity = $this->model::findOrNew($id);

        $entity->name = $data['name'];
        $entity->slug  =str_slug($data['name']);
        $entity->is_active = !empty($data['is_active']);
        $entity->city_id = $data['city_id'];

        return $entity->save();
    }

    /**
     * Get categories list for select
     *
     * @return array
     */
    public function categoriesForDropDown()
    {
        $category = new CategoryRepository();

        return $category->allActive()->pluck('name', 'id');
    }

    /**
     * Get categories list for select
     *
     * @return \Illuminate\Support\Collection
     */
    public function typesForDropDown()
    {
        $types = new TypeRepository();

        return $types->allActive();
    }

    /**
     * Get categories list for select
     *
     * @return \Illuminate\Support\Collection
     */
    public function districtsForDropDown()
    {
        $types = new DistrictRepository();

        return $types->allActive();
    }
}