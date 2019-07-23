<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\JsonHelpers;
use App\Http\Requests\StorePreviousRecordRequest;
use App\Repositories\PreviousRecordRepository;
use App\Structure;


/**
 * @property PreviousRecordRepository repository
 */
class PreviousRecordController extends Controller
{
    use JsonHelpers;

    public function __construct(PreviousRecordRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(StorePreviousRecordRequest $request)
    {
        $structureId = request('structure_id');
        $structure = Structure::whereUuid($structureId)->firstOrFail();

        if (! optional($structure)->is_previous_record_available) {
            return $this->jsonError("Ви не можете створювати запити для даного об'экта", 500);
        }

        if ($this->repository->createFromUser(request()->except('_token'))) {
            return $this->jsonMessage('Ваш запит прийнято і буде розглянута найближчим часом.');
        }

        return $this->jsonError("Помилка при створеннi запиту", 500);
    }
}
