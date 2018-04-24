<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\StrucutreRepository;
use App\Structure;

class StructureController extends BaseAdminController
{
    public function __construct(StrucutreRepository $repository)
    {
        $this->model = Structure::class;
        $this->repository = $repository;
        parent::__construct();
    }
}
