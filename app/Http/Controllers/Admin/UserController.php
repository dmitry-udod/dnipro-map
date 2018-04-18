<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use App\User;

class UserController extends BaseAdminController
{
    public function __construct(UserRepository $repository)
    {
        $this->model = User::class;
        $this->repository = $repository;
        parent::__construct();
    }
}
