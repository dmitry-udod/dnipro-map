<?php

namespace App\Repositories;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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