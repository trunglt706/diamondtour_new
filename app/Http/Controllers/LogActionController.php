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

    /**
     * Display the log action index page.
     *
     * @param LogActionViewRequest $request
     * @return void
     */
    public function index(LogActionViewRequest $request)
    {
        return view('user.pages.log_action.index');
    }

    /**
     * Display a listing of the log actions.
     *
     * @param LogActionViewRequest $request
     * @return void
     */
    public function list(LogActionViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
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

    /**
     * View details of a log action.
     *
     * @param [type] $id
     * @param LogActionViewRequest $request
     * @return void
     */
    public function detail($id, LogActionViewRequest $request)
    {
        $data = LogAction::with('user')->findOrFail($id);
        return view('user.pages.log_action.detail', compact('data'));
    }
}
