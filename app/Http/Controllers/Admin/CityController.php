<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Requests\StoreCity;
use App\Repositories\CityRepository;

class CityController extends BaseAdminController
{
    public function __construct(CityRepository $repository)
    {
        $this->model = City::class;
        $this->repository = $repository;
        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCity  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCity $request)
    {
        $this->repository->save($request->except('_token'));

        return $this->redirectToList();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreCity $request, $id)
    {

        $this->repository->save($request->except('_token'), $id);

        return $this->redirectToList();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
