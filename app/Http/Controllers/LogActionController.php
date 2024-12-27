<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LogAction\LogActionViewRequest;
use App\Models\LogAction;

class LogActionController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    public function index(LogActionViewRequest $request)
    {
        return view('user.pages.log_action.index');
    }

    public function list(LogActionViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');
            $user_id = request('user_id', '');
            $date = request('date', '');

            $list = LogAction::with('user');
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $user_id != '' ? $list->userId($user_id) : $list;
            $list = $date != '' ? $list->date($date) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.log_action.table', compact('list'))->render(),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response()->json([
                'status' => false,
                'data' => '',
            ]);
        }
    }

    public function detail($id, LogActionViewRequest $request)
    {
        $data = LogAction::with('user')->findOrFail($id);
        return view('user.pages.log_action.detail', compact('data'));
    }
}
