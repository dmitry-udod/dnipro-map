<?php

namespace App\Repositories;

use Carbon\Carbon;

class BaseRepository
{
    public $model;
    
    protected $order = 'DESC';

    protected $orderBy = 'created_at';

    /**
     * Get all entities
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model::orderBy($this->orderBy, $this->order);
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
     * Upload file for specific context     *
     *
     * @param $field
     * @param $context
     * @return string
     */
    public function uploadFile($field, $context)
    {
        if (request()->hasFile($field)) {
            $file = request()->file($field);

            $ext = last(explode('.', $file->getClientOriginalName()));
            $uniqFileName = md5(uniqid("uploads/$context", true)) . '.' . $ext;
            $path = public_path("uploads/$context");
            $file->move($path, $uniqFileName);
            return json_encode([
                'path' => "/uploads/$context/$uniqFileName",
                'original_name' => $file->getClientOriginalName(),
                'name' => $uniqFileName,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    /**
     * Get all active entities
     *
     * @return \Illuminate\Support\Collection
     */
    public function allActive()
    {
        return $this->all()->where('is_active', true)->get();
    }
}