<?php

namespace App\Http\Controllers\Admin;

class StatisticsController extends BaseAdminController
{
    public function index()
    {
        return view('admin.statistics');
    }
}
