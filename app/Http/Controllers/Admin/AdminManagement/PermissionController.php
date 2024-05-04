<?php

namespace App\Http\Controllers\Admin\AdminManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissonRequest;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(): View
    {
        $data['permissions'] = Permission::with('created_user')->latest()->get();
        return view('admin.admin_management.permission.index',$data);
    }
    public function details($id): JsonResponse
    {
        $data = Permission::with(['created_user','updated_user'])->findOrFail($id);
        $data->creating_time = timeFormate($data->created_at);
        $data->updating_time = timeFormate($data->updated_at);
        $data->created_by = c_user_name($data->created_user);
        $data->updated_by = u_user_name($data->updated_user);
        return response()->json($data);
    }
    public function create(): View
    {
        return view('admin.admin_management.permission.create');
    }
    public function store(PermissonRequest $req): RedirectResponse
    {
        $permission = new Permission();
        $permission->name = $req->name;
        $permission->prefix = $req->prefix;
        $permission->guard_name = 'admin';
        $permission->created_by = admin()->id;
        $permission->save();
        flash()->addSuccess('Permission '.$permission->name.' created successfully.');
        return redirect()->route('am.permission.permission_list');
    }
    public function edit($id): View
    {
        $data['permission'] = Permission::findOrFail($id);
        return view('admin.admin_management.permission.edit',$data);
    }
    public function update(PermissonRequest $req, $id): RedirectResponse
    {
        $permission = Permission::findOrFail($id);
        $permission->name = $req->name;
        $permission->prefix = $req->prefix;
        $permission->guard_name = 'admin';
        $permission->updated_by = admin()->id;
        $permission->update();

        flash()->addSuccess('Permission '.$permission->name.' updated successfully.');
        return redirect()->route('am.permission.permission_list');
    }
    // public function status($id): RedirectResponse
    // {
    //     $permission = Admin::findOrFail($id);
    //     $this->statusChange($permission);
    //     flash()->addSuccess('Admin '.$permission->name.' status updated successfully.');
    //     return redirect()->route('am.admin.admin_list');
    // }
    // public function delete($id): RedirectResponse
    // {
    //     $permission = Admin::findOrFail($id);
    //     $permission->delete();
    //     flash()->addSuccess('Admin '.$permission->name.' deleted successfully.');
    //     return redirect()->route('am.admin.admin_list');

    // }

}
