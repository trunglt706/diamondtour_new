<?php

namespace App\Http\Controllers;

use App\Exports\NewllterExport;
use App\Http\Requests\Newllter\NewllterDeleteRequest;
use App\Http\Requests\Newllter\NewllterUpdateRequest;
use App\Http\Requests\Newllter\NewllterViewRequest;
use App\Models\Newllter;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NewllterController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    /**
     * Display the newllter index page.
     *
     * @param NewllterViewRequest $request
     * @return void
     */
    public function index(NewllterViewRequest $request)
    {
        $data['status'] = Newllter::get_status();
        return view('user.pages.newllter.index', compact('data'));
    }

    /**
     * Display a listing of the newllters.
     *
     * @param NewllterViewRequest $request
     * @return void
     */
    public function list(NewllterViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');
            $export = request('export', '');

            $list = Newllter::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            if ($export == 1) {
                return Excel::download(new NewllterExport($list->latest()->get()), 'newllter');
            }
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.newllter.table', compact('list'))->render(),
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
     * Update an existing newllter.
     *
     * @param NewllterUpdateRequest $request
     * @return void
     */
    public function update(NewllterUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Newllter::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            save_log("Newllter #$new->code vừa mới được cập nhật", $data);
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    /**
     * Delete an existing newllter.
     *
     * @param NewllterDeleteRequest $request
     * @return void
     */
    public function delete(NewllterDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Newllter::findOrFail(request('id'));
            $new->delete();
            save_log("Newllter #$new->code vừa mới bị xóa", $new);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Xóa thành công',
                'type' => 'success',
            ]);
        } catch (\Throwable $th) {
            showLog($th);
        }
        DB::rollBack();
        return response()->json([
            'status' => false,
            'message' => 'Có lỗi xãy ra!',
            'type' => 'error',
        ]);
    }

    /**
     * Display the details of a specific newllter.
     *
     * @param [type] $id
     * @param NewllterViewRequest $request
     * @return void
     */
    public function detail($id, NewllterViewRequest $request)
    {
        $data = Newllter::findOrFail($id);
        $status = Newllter::get_status($data->status);
        return view('user.pages.newllter.detail', compact('data', 'status'));
    }

    /**
     * Accept a newllter.
     *
     * @return void
     */
    public function accept()
    {
        DB::beginTransaction();
        try {
            $new = Newllter::findOrFail(request('id'));
            $new->status = Newllter::STATUS_ACTIVE;
            $new->save();
            save_log("Newllter #$new->code vừa mới được duyệt", $new);
            DB::commit();
            return redirect()->back()->with('success', 'Duyệt dữ liệu thành công');
        } catch (\Throwable $th) {
            showLog($th);
        }
        DB::rollBack();
        return redirect()->back()->with('error', 'Duyệt dữ liệu thất bại!');
    }
}
