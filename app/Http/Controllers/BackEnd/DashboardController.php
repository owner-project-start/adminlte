<?php

namespace App\Http\Controllers\BackEnd;

class DashboardController extends ParentController
{
    public function index()
    {
        return view('pages.dashboard.index');
    }
}
