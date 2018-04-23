<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StructureController extends \App\Http\Controllers\Admin\BaseAdminController
{
    public function __construct(\App\Repositories\StrucutreRepository $repository)
    {
        $this->model = \App\Structure::class;
        $this->repository = $repository;
        parent::__construct();
    }
}
