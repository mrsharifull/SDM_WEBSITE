<?php

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\BloodGroupRequest;
use App\Models\BloodGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BloodGroupController extends Controller
{
    function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(): View
    {
        $data['blood_groups'] = BloodGroup::with('created_user')->orderBy('name')->get();
        return view('admin.setup.blood_group.index',$data);
    }
    public function details($id): JsonResponse
    {
        $data = BloodGroup::with(['created_user','updated_user'])->findOrFail($id);
        $data->creating_time = timeFormate($data->created_at);
        $data->updating_time = timeFormate($data->updated_at);
        $data->created_by = c_user_name($data->created_user);
        $data->updated_by = u_user_name($data->updated_user);
        return response()->json($data);
    }
    public function create(): View
    {
        return view('admin.setup.blood_group.create');
    }
    public function store(BloodGroupRequest $req): RedirectResponse
    {
        $blood_group = new BloodGroup();
        $blood_group->name = $req->name;
        $blood_group->created_by = admin()->id;
        $blood_group->save();
        flash()->addSuccess('Bloodgroup '.$blood_group->name.' created successfully.');
        return redirect()->route('setup.bg.bg_list');
    }
    public function edit($id): View
    {
        $data['blood_group'] = BloodGroup::findOrFail($id);
        return view('admin.setup.blood_group.edit',$data);
    }
    public function update(BloodGroupRequest $req, $id): RedirectResponse
    {
        $blood_group = BloodGroup::findOrFail($id);
        $blood_group->name = $req->name;
        $blood_group->updated_by = admin()->id;
        $blood_group->update();

        flash()->addSuccess('Bloodgroup '.$blood_group->name.' updated successfully.');
        return redirect()->route('setup.bg.bg_list');
    }
    public function status($id): RedirectResponse
    {
        $blood_group = BloodGroup::findOrFail($id);
        $this->statusChange($blood_group);
        flash()->addSuccess('Bloodgroup '.$blood_group->name.' status updated successfully.');
        return redirect()->route('setup.bg.bg_list');
    }
    public function delete($id): RedirectResponse
    {
        $blood_group = BloodGroup::findOrFail($id);
        $blood_group->delete();
        flash()->addSuccess('Bloodgroup '.$blood_group->name.' deleted successfully.');
        return redirect()->route('setup.bg.bg_list');

    }
}
