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
        /** @var City $city */
        $city = session('currentCity');
        $entity = $this->model::findOrNew($id);

        if (!$id) {
            $entity->uuid = $this->genrateUuid();
        }

        $entity->address = array_get($data, 'address');
        $entity->name = array_get($data, 'name');
        $entity->city_id = $city->id;
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
        $entity->is_active = !empty($data['is_active']);
        $entity->has_problem = !empty($data['has_problem']);
        $entity->is_free = !empty($data['is_free']);

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


    function genrateUuid()
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}