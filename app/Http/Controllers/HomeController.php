<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\StructureRepository;
use Illuminate\Http\Request;

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
        dd($this->repository->allByCityAndCategory($city, $category));

        return view('welcome');
    }
}
