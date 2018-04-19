<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreType;
use App\Repositories\TypeRepository;
use App\Type;

class TypeController extends BaseAdminController
{
    public function __construct(TypeRepository $repository)
    {
        $this->model = Type::class;
        $this->repository = $repository;
        parent::__construct();
    }
}
