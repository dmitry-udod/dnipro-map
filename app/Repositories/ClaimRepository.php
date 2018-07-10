<?php

namespace App\Repositories;

use App\Category;
use App\City;
use App\Claim;
use App\Mail\AdminMakeResponseOnUserClaim;
use App\Mail\ClaimCreatedNotifyAdmin;
use App\Mail\UserCreatedClaim;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ClaimRepository extends BaseRepository
{
    /**
     * CityRepository constructor.
     */
    public function __construct()
    {
        $this->model = Claim::class;
    }

    /**
     * Get entities list
     * @todo Refactor this
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function all()
    {
        return $this->allFilteredByUserCity();
    }

    /**
     * Store claim from user
     *
     * @param array $data
     * @param string $citySlug
     * @return bool
     */
    public function createFromUser(array $data, $citySlug)
    {
        $cityRepository = new CityRepository();
        $entity = new Claim();

        $city = $cityRepository->findBySlug($citySlug);

        if (! empty($data['structure_id'])) {
            $structureRepository = new StructureRepository();
            $structure = $structureRepository->findByUuid($data['structure_id']);
            $entity->structure_id = $structure->id;
            $entity->category_id = $structure->category_id;
        } else {
            $entity->structure_id = 0;
            $entity->category_id = $data['current_category_id'];
        }

        $entity->name = $data['name'];
        $entity->uuid = $this->generateUuid();
        $entity->phone = $data['phone'];
        $entity->email = trim($data['email']);
        $entity->claim_category_id = $data['category'];
        $entity->description = $data['description'];
        $entity->city_id = $city->id;
        $entity->save();

        if ($entity->id && !empty($data['photos'])) {
            $entity->photos = $this->uploadFiles($data['photos'], "claims/{$entity->id}");
        }

        Mail::to($data['email'])->send(new UserCreatedClaim($entity));

        $responsibleAdminIds = Category::where('id', $entity->category_id)->pluck('responsible_user_id');
        if ($responsibleAdminIds->isNotEmpty()) {
            $responsibleAdminEmails = User::whereIn('id', $responsibleAdminIds)->pluck('email');
            if ($responsibleAdminEmails->isNotEmpty()) {
                Mail::to($responsibleAdminEmails)->send(new ClaimCreatedNotifyAdmin($entity));
            }
        }

        return $entity->save();
    }

    /**
     * Process claim by admin
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

            Mail::to([$entity->email])->send(new AdminMakeResponseOnUserClaim($entity));
        }

        return $entity;
    }
}