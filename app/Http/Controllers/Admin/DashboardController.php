<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function __construct()
    {
        return $this->middleware('admin');
    }

    
    function dashboard():View
    {
        return view('admin.dashboard');
    }
}
