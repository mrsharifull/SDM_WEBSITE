<?php

namespace App\Http\Controllers\Admin\AdminManagement;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(): View
    {
        $data['admins'] = Admin::with(['role','created_user'])->latest()->get();
        return view('admin.admin_management.admin.index',$data);
    }
   

    
}
