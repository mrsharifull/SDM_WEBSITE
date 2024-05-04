<?php

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardRequest;
use App\Models\Board;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BoardCointroller extends Controller
{
    function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(): View
    {
        $data['boards'] = Board::with('created_user')->orderBy('name')->get();
        return view('admin.setup.board.index',$data);
    }
    public function details($id): JsonResponse
    {
        $data = Board::with(['created_user','updated_user'])->findOrFail($id);
        $data->creating_time = timeFormate($data->created_at);
        $data->updating_time = timeFormate($data->updated_at);
        $data->created_by = c_user_name($data->created_user);
        $data->updated_by = u_user_name($data->updated_user);
        return response()->json($data);
    }
    public function create(): View
    {
        return view('admin.setup.board.create');
    }
    public function store(BoardRequest $req): RedirectResponse
    {
        $board = new Board();
        $board->name = $req->name;
        $board->created_by = admin()->id;
        $board->save();
        flash()->addSuccess('Board '.$board->name.' created successfully.');
        return redirect()->route('setup.board.board_list');
    }
    public function edit($id): View
    {
        $data['board'] = Board::findOrFail($id);
        return view('admin.setup.board.edit',$data);
    }
    public function update(BoardRequest $req, $id): RedirectResponse
    {
        $board = Board::findOrFail($id);
        $board->name = $req->name;
        $board->updated_by = admin()->id;
        $board->update();

        flash()->addSuccess('Board '.$board->name.' updated successfully.');
        return redirect()->route('setup.board.board_list');
    }
    public function status($id): RedirectResponse
    {
        $board = Board::findOrFail($id);
        $this->statusChange($board);
        flash()->addSuccess('Board '.$board->name.' status updated successfully.');
        return redirect()->route('setup.board.board_list');
    }
    public function delete($id): RedirectResponse
    {
        $board = Board::findOrFail($id);
        $board->delete();
        flash()->addSuccess('Board '.$board->name.' deleted successfully.');
        return redirect()->route('setup.board.board_list');

    }
}
