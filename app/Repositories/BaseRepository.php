<?php

namespace App\Repositories;

use App\City;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BaseRepository
{
    public $model;

    public $order = 'DESC';

    public $orderBy = 'created_at';

    protected $searchFields = [];

    /**
     * Get all entities
     *
     * @return mixed
     */
    public function all()
    {
        return $this->search($this->model::orderBy($this->orderBy, $this->order));
    }

    /**
     * Find or throw exception
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * Find entity by uuid
     *
     * @param $uuid
     * @return mixed
     */
    public function findByUuid($uuid)
    {
        return $this->model::where('uuid', $uuid)->first();
    }

    /**
     * Find or create new entity
     *
     * @param $id
     * @return mixed
     */
    public function findOrNew($id)
    {
        return $this->model::findOrNew($id);
    }

    /**
     * Upload file for specific context
     *
     * @param $field
     * @param $context
     * @return string
     */
    public function uploadFile($field, $context)
    {
        if (request()->hasFile($field)) {
            $file = request()->file($field);
            return $this->processFile($file, $context);
        }
    }

    /**
     * Upload files for specific context
     *
     * @param array $files
     * @param $context
     * @return array
     */
    public function uploadFiles($files, $context)
    {
        $data = [];

        foreach ($files as $file) {
            $data[] = $this->processFile($file, $context);
        }

        return $data;
    }

    /**
     * Get all active entities
     *
     * @return \Illuminate\Support\Collection
     */
    public function allActive()
    {
        return $this->allActiveQuery()->get();
    }

    /**
     * Get all active entities
     *
     * @return \Illuminate\Support\Collection
     */
    public function allActiveOrderByName()
    {
        $this->orderBy = 'name';
        $this->order = 'ASC';
        return $this->allActiveQuery()->get();
    }

    /**
     * Get all active entities (query)
     *
     * @return mixed
     */
    public function allActiveQuery()
    {
        return $this->all()->where('is_active', true);
    }

    /**
     * Generate UUID
     *
     * @return string
     */
    public function generateUuid()
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }


    /**
     * Search entities for specific params
     *
     * @param Builder $q
     * @return Builder
     */
    protected function search($q)
    {
        $search = request('q');
        if (count($this->searchFields) && $search) {
            $fields = $this->searchFields;
            $q->where(function ($query) use ($search, $fields) {
                foreach ($fields as $field) {
                    $query->orWhere($field, 'ILIKE', "%$search%");
                }
            });
        }

        return $q;
    }

    /**
     * @return Builder
     */
    protected function allFilteredByUserCity()
    {
        $user = auth()->user();
        $q = $this->model::orderBy('created_at', 'DESC');

        if ($user->isAdmin()) {
            $cities = empty($user->cities) ? [] : City::whereIn('id', $user->cities)->pluck('id');
            $q->whereIn('city_id', $cities);
        }

        return $q;
    }

    /**
     * Upload Files
     *
     * @param UploadedFile $file
     * @param $context
     * @return string
     */
    private function processFile($file, $context)
    {
        $ext = last(explode('.', $file->getClientOriginalName()));
        $uniqFileName = md5(uniqid("uploads/$context", true)) . '.' . $ext;
        $path = public_path("uploads/$context");
        try {
            $file->move($path, $uniqFileName);
        } catch (\Exception $e) {
            logger()->error('Cant save category file', [$e]);
        }

        return json_encode([
            'path' => "/uploads/$context/$uniqFileName",
            'original_name' => $file->getClientOriginalName(),
            'name' => $uniqFileName,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}