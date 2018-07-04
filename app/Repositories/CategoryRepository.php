<?php

namespace App\Repositories;


use App\City;
use App\Category;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository
{
    protected $searchFields = ['name'];

    /**
     * CategoryRepository constructor.
     */
    public function __construct()
    {
        $this->model = \App\Category::class;
    }

    /**
     * Get all categories
     *
     * @return  \Illuminate\Database\Query\Builder
     */
	public function all()
	{
		$user = auth()->user();
		$q = Category::orderBy('id', 'DESC');

		if ($user->isAdmin()) {
			$cities = empty($user->cities) ? [] : City::whereIn('id', $user->cities)->pluck('id');
			$q->whereIn('city_id', $cities);
		}

        $q = $this->search($q);

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
        $entity->responsible_user_id = array_get($data, 'responsible_user_id');
        $entity->user_can_create_claims = !empty($data['user_can_create_claims']);

        if (!empty($data['additional_fields'])) {
            $entity->additional_fields = $data['additional_fields'];
        }

        $file = $this->uploadFile('logo', 'categories');

        if (!empty($file)) {
            $entity->logo = $file;
        }

        $entity->save();

        return $entity;
    }

    /**
     * Get all active categories for specific city
     *
     * @param City $city
     * @return Collection
     */
    public function allActiveForCity(City $city)
    {
        $q = Category::orderBy('order')
            ->where('is_active', true)
            ->where('city_id', $city->id)
        ;

        return $q->get();
    }

    public function findBySlug(City $city, $slug)
    {
        return Category::where('is_active', true)
            ->where('slug', $slug)
            ->where('city_id', $city->id)
            ->first();
    }

    public function findByCityAndSlugOrCreate(City $city, array $data)
    {
        $slug = $data['slug'];

        $category = $this->active()
            ->where('city_id', $city->id)
            ->where('slug', $slug)
            ->first();

        if (! $category) {
            return $this->save($data);
        }

        return $category;
    }

    /**
     * @return Builder
     */
    private function active()
    {
        return Category::where('is_active', true);
    }
}