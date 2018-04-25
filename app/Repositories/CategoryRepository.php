<?php

namespace App\Repositories;


use App\City;
use App\Category;

class CategoryRepository extends BaseRepository
{
    /**
     * Get all categories
     *
     * @return  \Illuminate\Database\Query\Builder
     */
	public function all()
	{
		$user = auth()->user();
		$q = Category::orderBy('order');

		if ($user->isAdmin()) {
			$cities = empty($user->cities) ? [] : City::whereIn('id', $user->cities)->pluck('id');
			$q->whereIn('city_id', $cities);
		}

		return $q;
	}

    /**
     * Save Entity
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
        $entity->is_active = !empty($data['is_active']);
        $entity->order = $data['order'];

        $file = $this->uploadFile('logo', 'categories');
        if (!empty($file)) {
            $entity->logo = $file;
        }

        return $entity->save();
    }
}