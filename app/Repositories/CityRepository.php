<?php

namespace App\Repositories;


use App\City;

class CityRepository extends BaseRepository
{
    /**
     * Save entity
     *
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function save(array $data, $id = null)
    {
        $city = City::findOrNew($id);

        $city->name = $data['name'];
        $city->slug  = empty($city['slug']) ? str_slug($data['name']) : $data['slug'];

        return $city->save();
    }

    /**
     * Find city by slug
     *
     * @param $slug
     * @return City
     */
    public function findBySlug($slug)
    {
        return City::where('slug', $slug)->firstOrFail();
    }
}