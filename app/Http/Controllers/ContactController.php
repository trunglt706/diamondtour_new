<?php

namespace App\Http\Controllers;

use App\Exports\ContactExport;
use App\Http\Requests\User\Contact\ContactDeleteRequest;
use App\Http\Requests\User\Contact\ContactInsertRequest;
use App\Http\Requests\User\Contact\ContactUpdateRequest;
use App\Http\Requests\User\Contact\ContactViewRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    /**
     * Display index page of the resource.
     *
     * @param ContactViewRequest $request
     * @return void
     */
    public function index(ContactViewRequest $request)
    {
        $data['status'] = Contact::get_status();
        return view('user.pages.contact.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param ContactViewRequest $request
     * @return void
     */
    public function list(ContactViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');
            $export = request('export', '');

            $list = Contact::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            if ($export == 1) {
                return Excel::download(new ContactExport($list->latest()->get()), 'contact');
            }
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.contact.table', compact('list'))->render(),
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
     * Insert a newly created resource in storage.
     *
     * @param ContactInsertRequest $request
     * @return void
     */
    public function insert(ContactInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Contact::create($data);
            save_log("Liên hệ #$new->code vừa mới được tạo", $data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactUpdateRequest $request
     * @return void
     */
    public function update(ContactUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Contact::findOrFail(request('id'));
            $new->update($data);
            save_log("Liên hệ #$new->code vừa mới được cập nhật", $data);
            DB::commit();
            if (request()->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Cập nhật thành công',
                    'type' => 'success',
                ]);
            }
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            if (request()->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Có lỗi xãy ra!',
                    'type' => 'error',
                ]);
            }
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContactDeleteRequest $request
     * @return void
     */
    public function delete(ContactDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Contact::findOrFail(request('id'));
            $new->delete();
            save_log("Liên hệ #$new->code vừa mới bị xóa", $new);
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param [type] $id
     * @param ContactViewRequest $request
     * @return void
     */
    public function detail($id, ContactViewRequest $request)
    {
        $data = Contact::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.contact.show', compact('data'))->render();
        }
        $status = Contact::get_status($data->status);
        return view('user.pages.contact.detail', compact('data', 'status'));
    }

    /**
     * Accept the specified resource.
     *
     * @return void
     */
    public function accept()
    {
        DB::beginTransaction();
        try {
            $new = Contact::findOrFail(request('id'));
            $new->status = Contact::STATUS_ACTIVE;
            $new->save();
            save_log("Liên hệ #$new->code vừa mới được duyệt", $new);
            DB::commit();
            return redirect()->back()->with('success', 'Duyệt dữ liệu thành công');
        } catch (\Throwable $th) {
            showLog($th);
        }
        DB::rollBack();
        return redirect()->back()->with('error', 'Duyệt dữ liệu thất bại!');
    }
}
