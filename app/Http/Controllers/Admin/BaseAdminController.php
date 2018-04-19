<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;

class BaseAdminController extends Controller
{
    protected $model = null;
    protected $viewName = null;
    protected $repository = null;

    public function __construct()
    {
        $this->viewName = str_plural(last(explode('\\', strtolower($this->model))));
        view()->share('viewName', $this->viewName);
        view()->share('model', $this->model);
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
    public function edit($city = null, $id = null)
    {
        if ((int)$city > 0) {
            $id = $city;
        }

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
     * Redirect to items list
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToListWithFlash($type = 'success', $message = 'Запис успiшно збережено')
    {
        flash($message)->$type();

        return $this->redirectToList();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($city = null, $id = null)
    {
        $this->model::findOrFail($id);

        if ($this->model::destroy($id)) {
            flash('Запис успiшно видалено')->success();
            $name = request()->user()->name;
            logger()->info("User $name delete {$this->model}; id: $id");
        }
       
       return $this->redirectToList();
    }
}
