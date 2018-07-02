<?php

namespace App\Http\Controllers\Admin;

use App\Claim;
use App\Http\Requests\StoreClaim;
use App\Repositories\ClaimRepository;

class ClaimController extends BaseAdminController
{
    public function __construct(ClaimRepository $repository)
    {
        $this->model = Claim::class;
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
