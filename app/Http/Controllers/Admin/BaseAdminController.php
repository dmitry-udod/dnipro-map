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
        $this->repository->model = $this->model;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = $this->repository->find($id);

        return view("admin.{$this->viewName}.form", compact('entity'));
    }

    /**
     * Redirect to items list
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToList()
    {
        return redirect()->route("admin.$this->viewName.index", session('currentCity')->slug);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->model::destroy($id)) {
            logger()->info("User delete {$this->model}; id: $id");
        }
       
       return $this->redirectToList();
    }
}
