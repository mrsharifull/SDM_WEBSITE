<?php

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\SessionRequest;
use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SessionController extends Controller
{
    function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(): View
    {
        $data['sessions'] = Session::with('created_user')->orderBy('session')->get();
        return view('admin.setup.session.index',$data);
    }
    public function details($id): JsonResponse
    {
        $data = Session::with(['created_user','updated_user'])->findOrFail($id);
        $data->creating_time = timeFormate($data->created_at);
        $data->updating_time = timeFormate($data->updated_at);
        $data->created_by = c_user_name($data->created_user);
        $data->updated_by = u_user_name($data->updated_user);
        return response()->json($data);
    }
    public function create(): View
    {
        return view('admin.setup.session.create');
    }
    public function store(SessionRequest $req): RedirectResponse
    {
        $session = new Session();
        $session->session = $req->session;
        $session->created_by = admin()->id;
        $session->save();
        flash()->addSuccess('Session '.$session->session.' created successfully.');
        return redirect()->route('setup.session.session_list');
    }
    public function edit($id): View
    {
        $data['session'] = Session::findOrFail($id);
        return view('admin.setup.session.edit',$data);
    }
    public function update(SessionRequest $req, $id): RedirectResponse
    {
        $session = Session::findOrFail($id);
        $session->session = $req->session;
        $session->updated_by = admin()->id;
        $session->update();

        flash()->addSuccess('Session '.$session->session.' updated successfully.');
        return redirect()->route('setup.session.session_list');
    }
    public function status($id): RedirectResponse
    {
        $session = Session::findOrFail($id);
        $this->statusChange($session);
        flash()->addSuccess('Session '.$session->session.' status updated successfully.');
        return redirect()->route('setup.session.session_list');
    }
    public function delete($id): RedirectResponse
    {
        $session = Session::findOrFail($id);
        $session->delete();
        flash()->addSuccess('Session '.$session->session.' deleted successfully.');
        return redirect()->route('setup.session.session_list');

    }
}
