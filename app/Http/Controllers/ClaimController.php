<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\JsonHelpers;
use App\Http\Requests\StoreUserClaim;
use App\Repositories\ClaimRepository;
use App\Repositories\StructureRepository;


/**
 * @property ClaimRepository repository
 */
class ClaimController extends Controller
{
    use JsonHelpers;

    public function __construct(ClaimRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create claim from user
     *
     * @param StoreUserClaim $request
     * @param $city
     * @return \Response
     */
    public function create(StoreUserClaim $request, $city)
    {
        if ($this->repository->createFromUser(request()->except('_token'), $city)) {
            return $this->jsonMessage('Ваша скарга прийнята і буде розглянута найближчим часом.');
        }

        return $this->jsonError("Помилка при створеннi скарги", 500);
    }

    public function checkStatus($city, $uuid = null)
    {
        if (request('q')) {
            return redirect()->route('claim_check_status', [$city, request('q')]);
        }

        $entity = $this->repository->findByUuid($uuid);

        return view('claims.check_status', compact('entity'));
    }
}
