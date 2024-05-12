<?php

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Class_;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SectionController extends Controller
{
    function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(): View
    {
        $data['sections'] = Section::with(['created_user','class_'])->get();
        return view('admin.setup.section.index',$data);
    }
    public function details($id): JsonResponse
    {
        $data = Section::with(['created_user','updated_user','class_'])->findOrFail($id);
        $data->creating_time = timeFormate($data->created_at);
        $data->updating_time = timeFormate($data->updated_at);
        $data->created_by = c_user_name($data->created_user);
        $data->updated_by = u_user_name($data->updated_user);
        return response()->json($data);
    }
    public function create(): View
    {
        $data['classes']= Class_::active()->orderBy('class_number','asc')->get();
        return view('admin.setup.section.create',$data);
    }
    public function store(SectionRequest $req): RedirectResponse
    {
        $section = new Section();
        $section->name = $req->name;
        $section->class_id = $req->class_id;
        $section->created_by = admin()->id;
        $section->save();
        flash()->addSuccess('Section '.$section->name.' created successfully.');
        return redirect()->route('setup.section.section_list');
    }
    public function edit($id): View
    {
        $data['classes']= Class_::active()->orderBy('class_number','asc')->get();
        $data['section'] = Section::findOrFail($id);
        return view('admin.setup.section.edit',$data);
    }
    public function update(SectionRequest $req, $id): RedirectResponse
    {
        $section = Section::findOrFail($id);
        $section->name = $req->name;
        $section->class_id = $req->class_id;
        $section->updated_by = admin()->id;
        $section->update();

        flash()->addSuccess('Section '.$section->name.' updated successfully.');
        return redirect()->route('setup.section.section_list');
    }
    public function status($id): RedirectResponse
    {
        $section = Section::findOrFail($id);
        $this->statusChange($section);
        flash()->addSuccess('Section '.$section->name.' status updated successfully.');
        return redirect()->route('setup.section.section_list');
    }
    public function delete($id): RedirectResponse
    {
        $section = Section::findOrFail($id);
        $section->delete();
        flash()->addSuccess('Section '.$section->name.' deleted successfully.');
        return redirect()->route('setup.section.section_list');

    }
}
