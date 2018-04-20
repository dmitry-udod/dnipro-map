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

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUser  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreType $request)
    {
        $this->repository->save($request->except('_token'));

        return $this->redirectToListWithFlash();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreUser  $request
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreType $request, $city, $id)
    {
        $this->repository->save($request->except('_token'), $id);

        return $this->redirectToListWithFlash();
    }
}
