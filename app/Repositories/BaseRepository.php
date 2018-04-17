<?php

namespace App\Repositories;

class BaseRepository
{
    public $model;
    
    protected $order = 'DESC';

    protected $orderBy = 'created_at';

    public function all()
    {
        return $this->model::orderBy($this->orderBy, $this->order);
    }

    public function find($id)
    {
        return $this->model::findOrFail($id);
    }

    public function findOrNew($id)
    {
        return $this->model::findOrNew($id);
    }
}