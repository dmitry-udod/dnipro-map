<?php

namespace App\Repositories;

use App\Mail\AdminMakeResponseOnStructureRequest;
use App\Mail\UserCreatedStructureRequest;
use App\StructureRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class StructureRequestRepository extends BaseRepository
{
    /**
     * Get entities list
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function all()
    {
        return $this->allFilteredByUserCity();
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

        $saved = $entity->save();

        if ($saved) {
            Mail::to($data['email'])->send(new UserCreatedStructureRequest($entity));
        }

        return $saved;
    }

    /**
     * Process structure request
     *
     * @param array $data
     * @param null $id
     * @return mixed
     */
    public function save(array $data, $id = null)
    {
        $entity = $this->findOrNew($id);

        if (! $entity->is_processed) {
            $entity->response = trim($data['response']);
            $entity->processed_by = auth()->user()->name;
            $entity->processed_at = Carbon::now();
            $entity->is_processed = true;
            $entity->save();

            Mail::to([$entity->email])->send(new AdminMakeResponseOnStructureRequest($entity));
        }
        return $entity;
    }
}