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

    public function create(StoreUserClaim $request, $city)
    {
        if ($this->repository->createFromUser(request()->except('_token'), $city)) {
            return $this->jsonMessage('Ваша скарга прийнята і буде розглянута найближчим часом.');
        }

        return $this->jsonError("Помилка при створеннi скарги", 500);
    }

    public function checkStatus()
    {
        if ($this->repository->createFromUser(request()->except('_token'), $city)) {
            return $this->jsonMessage('Ваша скарга прийнята і буде розглянута найближчим часом.');
        }

        return $this->jsonError("Помилка при створеннi скарги", 500);
    }
}
