<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUser;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUser  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUser $request)
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
    public function update(StoreUser $request, $city, $id)
    {
        $this->repository->save($request->except('_token'), $id);

        return $this->redirectToListWithFlash();
    }
}
