<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\ParentController;
use App\User;

class DashboardController extends ParentController
{
    public function index()
    {
        return view('pages.dashboard.index');
    }
}
