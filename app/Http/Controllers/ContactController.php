<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Contact\ContactDeleteRequest;
use App\Http\Requests\User\Contact\ContactInsertRequest;
use App\Http\Requests\User\Contact\ContactUpdateRequest;
use App\Http\Requests\User\Contact\ContactViewRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index(ContactViewRequest $request)
    {
        return view('user.pages.contact.index');
    }

    public function list(ContactViewRequest $request)
    {
        try {
            $limit = request('limit', 10);
            $status = request('status', '');
            $search = request('search', '');

            $list = Contact::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
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

    public function insert(ContactInsertRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Contact::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function update(ContactUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Contact::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function delete(ContactDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Contact::findOrFail(request('id'));
            $new->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    public function detail($id, ContactViewRequest $request)
    {
        $data = Contact::findOrFail($id);
        return view('user.pages.contact.detail', compact('data'));
    }
}
