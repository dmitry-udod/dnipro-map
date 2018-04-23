<?php

namespace App\Http\Controllers\Admin;

use App\District;
use App\Http\Requests\StoreDistirct;
use App\Repositories\DistrictRepository;

class DistrictController extends BaseAdminController
{
    public function __construct(DistrictRepository $repository)
    {
        $this->model = District::class;
        $this->repository = $repository;
        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCity  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDistirct $request)
    {
        $this->repository->save($request->except('_token'));

        return $this->redirectToListWithFlash();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreDistirct $request, $city,  $id)
    {
        $this->repository->save($request->except('_token'), $id);

        return $this->redirectToListWithFlash();
    }
}
