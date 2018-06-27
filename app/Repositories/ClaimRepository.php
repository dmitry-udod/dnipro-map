<?php

namespace App\Repositories;

use App\Claim;
use App\Mail\UserCreatedClaim;

class ClaimRepository extends BaseRepository
{
    /**
     * @param array $data
     * @param string $citySlug
     * @return bool
     */
    public function createFromUser(array $data, $citySlug)
    {
        $cityRepository = new CityRepository();
        $structureRepository = new StructureRepository();

        $city = $cityRepository->findBySlug($citySlug);
        $structure = $structureRepository->findByUuid($data['structure_id']);

        $entity = new Claim();
        $entity->name = $data['name'];
        $entity->uuid = $this->generateUuid();
        $entity->phone = $data['phone'];
        $entity->email = $data['email'];
        $entity->claim_category_id = $data['category'];
        $entity->description = $data['description'];
        $entity->city_id = $city->id;
        $entity->structure_id = $structure->id;
        $entity->category_id = $structure->category_id;
        $entity->save();

        if ($entity->id && !empty($data['photos'])) {
            $entity->photos = $this->uploadFiles($data['photos'], "claims/{$entity->id}");
        }

        \Mail::to($data['email'])->send(new UserCreatedClaim($entity));

        return $entity->save();
    }
}