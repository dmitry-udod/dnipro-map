<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseAdminController extends Controller
{
    protected $model = null;
    protected $viewName = null;
    protected $repository = null;

    public function __construct()
    {
        $this->viewName = str_plural(last(explode('\\', strtolower($this->model))));
        view()->share('viewName', $this->viewName);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$this->repository->model = $this->model;

    	$entities = $this->repository->all()->paginate();

        return view("admin.{$this->viewName}.index", compact('entities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.{$this->viewName}.form");
    }
}
