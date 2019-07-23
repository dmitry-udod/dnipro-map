<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreClaim;
use App\PreviousRecord;
use App\Repositories\PreviousRecordRepository;

class PreviousRecordController extends BaseAdminController
{
    public function __construct(PreviousRecordRepository $repository)
    {
        $this->model =  PreviousRecord::class;
        $this->repository = $repository;
        parent::__construct();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreClaim $request, $city,  $id)
    {
        $this->repository->save($request->except('_token'), $id);

        return $this->redirectToListWithFlash();
    }
}
