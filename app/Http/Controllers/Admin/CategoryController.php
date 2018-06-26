<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Repositories\CategoryRepository;
use App\Http\Requests\StoreCategory;

class CategoryController extends BaseAdminController
{
    public function __construct(CategoryRepository $repository)
    {
        $this->model = Category::class;
        $this->repository = $repository;
        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategory  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategory $request)
    {
        $this->repository->save($request->except('_token'));

        return $this->redirectToListWithFlash();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreCategory  $request
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreCategory $request, $city, $id)
    {
        $this->repository->save($request->except('_token'), $id);

        return $this->redirectToListWithFlash();
    }
}
