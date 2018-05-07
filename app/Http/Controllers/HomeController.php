<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\Structure;
use App\Repositories\StructureRepository;
use App\Repositories\TypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * @property StructureRepository repository
 */
class HomeController extends Controller
{
    public function __construct(StructureRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the map
     *
     * @return \Illuminate\Http\Response
     */
    public function index($city, $category = null)
    {
        $filters = ['type_ids' => request('types')];
        $entities = Structure::collection($this->repository->allByCityAndCategory($city, $category, $filters));
        $types = $entities->isEmpty() ? new Collection()  : (new TypeRepository)->allActiveForCategory($entities[0]->category_id);

        return view('welcome', compact('entities', 'types'));
    }
}
