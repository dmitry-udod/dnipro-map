<?php

namespace App\Repositories;

use App\Category;
use App\City;
use App\Structure;
use Illuminate\Database\Eloquent\Collection;

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
        $q = Structure::orderBy('id', 'DESC');

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
        /** @var City $city */
        $city = session('currentCity');
        $entity = Structure::findOrNew($id);

        if (!$id) {
            $entity->uuid = $this->generateUuid();
            $entity->city_id = array_get($data, 'city_id', $city->id);
        }

        $entity->address = array_get($data, 'address');
        $entity->name = array_get($data, 'name');
        $entity->category_id = array_get($data, 'category_id');
        $entity->type_id = array_get($data, 'type_id');
        $entity->district_id = array_get($data, 'district_id', 0);
        $entity->area = array_get($data, 'area');
        $entity->business = array_get($data, 'business');
        $entity->owner = array_get($data, 'owner');
        $entity->renter = array_get($data, 'renter');
        $entity->notes = array_get($data, 'notes');
        $entity->author_phone = array_get($data, 'author_phone');
        $entity->author_email = array_get($data, 'author_email');
        $entity->url = array_get($data, 'url');
        $entity->working_hours = array_get($data, 'working_hours');
        $entity->phone = array_get($data, 'phone');
        $entity->latitude = array_get($data, 'latitude');
        $entity->longitude = array_get($data, 'longitude');
        $entity->photos = array_get($data, 'photos', []);
        $entity->director = array_get($data, 'director', '');
        $entity->is_active = !empty($data['is_active']);
        $entity->has_problem = !empty($data['has_problem']);
        $entity->is_free = !empty($data['is_free']);
        if (!empty($data['additional_fields'])) {
            $entity->additional_fields = $data['additional_fields'];
        }

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

        return $category->allActive();
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

    /**
     * Find structures by city slug and category
     *
     * @param string $city
     * @param string $category
     * @param array $filters
     * @return \Illuminate\Support\Collection
     */
    public function allByCityAndCategory($city, $categorySlug, $filters)
    {
        $city = (new CityRepository())->findBySlug($city);
        $categoryQuery = Category::where('is_active', true)->where('city_id', $city->id)->orderBy('order');

        if (!$categorySlug) {
            $category = $categoryQuery->first();

            if (!$category) {
                return new Collection();
            }
        } else {
            $category = $categoryQuery->where('slug', $categorySlug)->first();
        }

        $q = Structure::where('is_active', true)->where('city_id', $city->id)->where('category_id', $category->id);

        if(!empty($filters['type_ids'])) {
            $q->whereIn('type_id', $filters['type_ids']);
        }

        return $q->get();
    }

    public function findByUuid($uuid)
    {
        return Structure::where('uuid', $uuid)->firstOrFail();
    }
}