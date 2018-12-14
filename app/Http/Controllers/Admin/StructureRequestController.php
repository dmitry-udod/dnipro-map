<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreClaim;
use App\Repositories\StructureRepository;
use App\Repositories\StructureRequestRepository;
use App\StructureRequest;

class StructureRequestController extends BaseAdminController
{
    public function __construct(StructureRequestRepository $repository)
    {
        $this->model = StructureRequest::class;
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

    /**
     * Create structure from structure request
     *
     * @param $city
     * @param $requestId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createStructureFromUserRequest($city, $requestId)
    {
        $structureRepository = new StructureRepository();

        try {
            $structureRepository->saveFromStructureRequest($requestId);
        } catch (\Exception $e){
            logger()->error('Cant create new structure', [$e]);
        }

        return $this->redirectToListWithFlash();
    }
}
