<?php

namespace App\Repositories;


use App\City;

class CategoryRepository extends BaseRepository
{
    public function save(array $data, $id = null)
    {
        $entity = $this->findOrNew($id);

        $entity->name = $data['name'];
        $entity->slug  = str_slug($data['name']);
        $entity->city_id  = (int) $data['city_id'];
        $entity->is_active = !empty($data['is_active']);
        $entity->order = $data['order'];
        $entity->logo = '{}';

        return $entity->save();
    }
}