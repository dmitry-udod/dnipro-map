<?php

namespace App\Repositories;

use App\Category;
use App\Mail\AdminMakeResponseOnUserClaim;
use App\Mail\PreviousRecordCreatedNotifyAdmin;
use App\PreviousRecord;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PreviousRecordRepository extends BaseRepository
{
    /**
     * CityRepository constructor.
     */
    public function __construct()
    {
        $this->model = PreviousRecord::class;
    }

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
     * Store claim from user
     *
     * @param array $data
     * @return bool
     */
    public function createFromUser(array $data)
    {
        $structureRepository = new StructureRepository();
        $structure = $structureRepository->findByUuid($data['structure_id']);

        $entity = new PreviousRecord();
        $entity->name = $data['name'];
        $entity->uuid = $this->generateUuid();
        $entity->age = $data['age'];
        $entity->parent_name = $data['parent_name'];
        $entity->parent_phone = $data['parent_phone'];
        $entity->date = $data['date'];
        $entity->notes = array_get($data, 'notes');
        $entity->structure_id = $structure->id;
        $entity->city_id = $structure->city_id;
        $entity->save();

        $responsibleAdminIds = Category::where('id', $structure->category_id)->pluck('responsible_user_id');
        if ($responsibleAdminIds->isNotEmpty()) {
            $responsibleAdminEmails = User::whereIn('id', $responsibleAdminIds)->pluck('email');
            if ($responsibleAdminEmails->isNotEmpty()) {
                Mail::to($responsibleAdminEmails)->send(new PreviousRecordCreatedNotifyAdmin($entity));
            }
        }

        return $entity->save();
    }

    /**
     * Process by admin
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
        }

        return $entity;
    }
}