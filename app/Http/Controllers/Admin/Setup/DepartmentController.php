<?php

namespace App\Http\Controllers\admin\setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(): View
    {
        $data['departments'] = Department::with('created_user')->orderBy('name')->get();
        return view('admin.setup.department.index',$data);
    }
    public function details($id): JsonResponse

    {
        $data = Department::with(['created_user','updated_user'])->findOrFail($id);
        $data->creating_time = timeFormate($data->created_at);
        $data->updating_time = timeFormate($data->updated_at);
        $data->created_by = c_user_name($data->created_user);
        $data->updated_by = u_user_name($data->updated_user);
        return response()->json($data);
    }
    public function create(): View
    {
        return view('admin.setup.department.create');
    }
    public function store(DepartmentRequest $req): RedirectResponse
    {
        $department = new Department();
        $department->name = $req->name;
        $department->created_by = admin()->id;
        $department->save();
        flash()->addSuccess('Department '.$department->name.' created successfully.');
        return redirect()->route('setup.department.department_list');
    }
    public function edit($id): View
    {
        $data['department'] = Department::findOrFail($id);
        return view('admin.setup.department.edit',$data);
    }
    public function update(DepartmentRequest $req, $id): RedirectResponse
    {
        $department = Department::findOrFail($id);
        $department->name = $req->name;
        $department->updated_by = admin()->id;
        $department->update();

        flash()->addSuccess('Department '.$department->name.' updated successfully.');
        return redirect()->route('setup.department.department_list');
    }
    public function status($id): RedirectResponse
    {
        $department = Department::findOrFail($id);
        $this->statusChange($department);
        flash()->addSuccess('Department '.$department->name.' status updated successfully.');
        return redirect()->route('setup.department.department_list');
    }
    public function delete($id): RedirectResponse
    {
        $department = Department::findOrFail($id);
        $department->delete();
        flash()->addSuccess('Department '.$department->name.' deleted successfully.');
        return redirect()->route('setup.department.department_list');

    }
}
