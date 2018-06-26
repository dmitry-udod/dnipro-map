<?php

namespace App\Http\Controllers\Admin;

use App\Claim;
use App\Http\Controllers\Controller;
use App\Repositories\ClaimRepository;

class ClaimController extends BaseAdminController
{
    public function __construct(ClaimRepository $repository)
    {
        $this->model = Claim::class;
        $this->repository = $repository;
        parent::__construct();
    }
}
