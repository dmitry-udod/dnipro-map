<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\JsonHelpers;
use App\Http\Requests\StoreNewStructureRequest;
use App\Repositories\StructureRequestRepository;


/**
 * @property StructureRequestRepository repository
 */
class NewStructureController extends Controller
{
    use JsonHelpers;

    public function __construct(StructureRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(StoreNewStructureRequest $request, $city)
    {
        if ($this->repository->createFromUser(request()->except('_token'), $city)) {
            return $this->jsonMessage('Ваша скарга прийнята і буде розглянута найближчим часом.');
        }

        return $this->jsonError("Помилка при створеннi скарги", 500);
    }
}
