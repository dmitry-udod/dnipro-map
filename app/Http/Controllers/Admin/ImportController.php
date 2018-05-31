<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUser;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\UserRepository;
use App\User;

class ImportController extends BaseAdminController
{
    public function __construct(UserRepository $repository)
    {
        $this->model = User::class;
        $this->repository = $repository;
        parent::__construct();
    }

    public function index()
    {
        $cities = (new CityRepository)->allActiveOrderByName();
        $categories = (new CategoryRepository())->allActiveOrderByName();

        return view('admin.import.index', compact('cities', 'categories'));
    }
}
