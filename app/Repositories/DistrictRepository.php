<?php

namespace App\Repositories;


use App\City;
use App\District;

class DistrictRepository extends BaseRepository
{
    /**
     * Get entities list
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function all()
    {
        $user = auth()->user();
        $q = District::orderBy('name');

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
}