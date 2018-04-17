<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Category;
use App\Repositories\CategoryRepository;

class CategoryController extends BaseAdminController
{
    public function __construct(CategoryRepository $repository)
    {
        $this->model = Category::class;
        $this->repository = $repository;
        parent::__construct();
    }
}
