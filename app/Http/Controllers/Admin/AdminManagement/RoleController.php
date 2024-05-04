<?php

namespace App\Http\Controllers\Admin\AdminManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        $data['roles'] = Role::with('created_user')->latest()->get();
        return view('admin.admin_management.role.index',$data);
    }
    public function details($id): JsonResponse
    {
        $data = Role::findOrFail($id);
        $data->creating_time = timeFormate($data->created_at);
        $data->updating_time = timeFormate($data->updated_at);
        $data->created_by = c_user_name($data->created_user);
        $data->updated_by = u_user_name($data->updated_user);
        $data->permissionNames = $data->permissions->pluck('name')->implode(' | ');
        return response()->json($data);
       
    }

    public function create(): View
    {
        $permissions = Permission::orderBy('name')->get();
        $data['groupedPermissions'] = $permissions->groupBy(function ($permission) {
            return $permission->prefix;
        });
        return view('admin.admin_management.role.create',$data);
    }

    public function store(RoleRequest $req): RedirectResponse
    {
        $role = new Role();
        $role->name = $req->name;
        $role->created_by = admin()->id;
        $role->save();

        $permissions = Permission::whereIn('id', $req->permissions)->pluck('name')->toArray();
        $role->givePermissionTo($permissions);
        flash()->addSuccess("$role->name role created successfully");
        return redirect()->route('am.role.role_list');


    }
    public function edit($id): View
    {
        $data['role'] = Role::findOrFail($id);
        $permissions = Permission::orderBy('name')->get();
        $data['groupedPermissions'] = $permissions->groupBy(function ($permission) {
            return $permission->prefix;
        });
        return view('admin.admin_management.role.edit',$data);
    }

    public function update(RoleRequest $req, $id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        $role->name = $req->name;
        $role->updated_by = admin()->id;
        $role->update();

        $permissions = Permission::whereIn('id', $req->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissions);
        flash()->addSuccess("$role->name role updated successfully");
        return redirect()->route('am.role.role_list');


    }
}
