<?php

namespace App\Http\Controllers\Admin\AdminManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
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
   
    public function create(): View
    {
        $data['roles'] = Role::latest()->get();
        return view('admin.admin_management.admin.create',$data);
    }
    public function store(AdminRequest $req): RedirectResponse
    {
        $admin = new Admin();
        $admin->name = $req->name;
        $admin->email = $req->email;
        $admin->role_id = $req->role;
        $admin->password = $req->password;
        $admin->created_by = admin()->id;
        $admin->save();

        $admin->assignRole($admin->role->name);

        flash()->addSuccess('Admin '.$admin->name.' created successfully.');
        return redirect()->route('am.admin.admin_list');
    }
   

    
}
