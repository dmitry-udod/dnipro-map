<?php

namespace App\Repositories;

use App\City;
use App\StructureRequest;

class StructureRequestRepository extends BaseRepository
{
    /**
     * Get entities list
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function all()
    {
        $user = auth()->user();
        $q = StructureRequest::orderBy('created_at', 'DESC');

        if ($user->isAdmin()) {
            $cities = empty($user->cities) ? [] : City::whereIn('id', $user->cities)->pluck('id');
            $q->whereIn('city_id', $cities);
        }

        return $q;
    }

    /**
     * @param array $data
     * @param string $citySlug
     * @return bool
     */
    public function createFromUser(array $data, $citySlug)
    {
        $cityRepository = new CityRepository();
        $categoryRepository = new CategoryRepository();

        $city = $cityRepository->findBySlug($citySlug);

        if (empty($data['category_id'])) {
            $category = (new CategoryRepository())->allActiveForCity($city)[0];
        } else {
            $category = $categoryRepository->find($data['category_id']);
        }

        $entity = new StructureRequest();
        $entity->name = $data['name'];
        $entity->address = $data['address'];
        $entity->latitude = $data['latitude'];
        $entity->longitude = $data['longitude'];
        $entity->uuid = $this->generateUuid();
        $entity->email = $data['email'];
        $entity->description = $data['description'];
        $entity->city_id = $city->id;
        $entity->category_id = $category->id;
        $entity->save();

        if ($entity->id && !empty($data['photos'])) {
            $entity->photos = $this->uploadFiles($data['photos'], "structure_requests/{$entity->id}");
        }

        return $entity->save();
    }
}