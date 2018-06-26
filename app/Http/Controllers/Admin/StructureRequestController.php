<?php

namespace App\Http\Controllers\Admin;

use App\Claim;
use App\Repositories\StructureRequestRepository;
use App\StructureRequest;

class StructureRequestController extends BaseAdminController
{
    public function __construct(StructureRequestRepository $repository)
    {
        $this->model = StructureRequest::class;
        $this->repository = $repository;
        parent::__construct();
    }
}
