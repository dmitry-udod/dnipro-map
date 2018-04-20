<?php

namespace App\Repositories;

use App\City;

class TypeRepository extends BaseRepository
{
    /**
     * Get entities list
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function all()
    {
        $user = auth()->user();
        $q = $this->model::orderBy('order');

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

        return $entity->save();
    }
}