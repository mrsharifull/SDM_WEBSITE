<?php

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;
use App\Models\Class_;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassController extends Controller
{
    function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(): View
    {
        $data['classes'] = Class_::with('created_user')->orderBy('class_number')->get();
        return view('admin.setup.class_.index',$data);
    }
    public function details($id): JsonResponse
    {
        $data = Class_::with(['created_user','updated_user'])->findOrFail($id);
        $data->creating_time = timeFormate($data->created_at);
        $data->updating_time = timeFormate($data->updated_at);
        $data->created_by = c_user_name($data->created_user);
        $data->updated_by = u_user_name($data->updated_user);
        return response()->json($data);
    }
    public function create(): View
    {
        return view('admin.setup.class_.create');
    }
    public function store(ClassRequest $req): RedirectResponse
    {
        $class = new Class_();
        $class->name = $req->name;
        $class->class_number = $req->class_number;
        $class->created_by = admin()->id;
        $class->save();
        flash()->addSuccess('Class '.$class->name.' created successfully.');
        return redirect()->route('setup.class.class_list');
    }
    public function edit($id): View
    {
        $data['class'] = Class_::findOrFail($id);
        return view('admin.setup.class_.edit',$data);
    }
    public function update(ClassRequest $req, $id): RedirectResponse
    {
        $class = Class_::findOrFail($id);
        $class->name = $req->name;
        $class->class_number = $req->class_number;
        $class->updated_by = admin()->id;
        $class->update();

        flash()->addSuccess('Class '.$class->name.' updated successfully.');
        return redirect()->route('setup.class.class_list');
    }
    public function status($id): RedirectResponse
    {
        $class = Class_::findOrFail($id);
        $this->statusChange($class);
        flash()->addSuccess('Class '.$class->name.' status updated successfully.');
        return redirect()->route('setup.class.class_list');
    }
    public function delete($id): RedirectResponse
    {
        $class = Class_::findOrFail($id);
        $class->delete();
        flash()->addSuccess('Class '.$class->name.' deleted successfully.');
        return redirect()->route('setup.class.class_list');

    }
}
