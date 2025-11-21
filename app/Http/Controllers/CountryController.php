<?php

namespace App\Http\Controllers;

use App\Http\Requests\Country\CountryCreateRequest;
use App\Http\Requests\Country\CountryDeleteRequest;
use App\Http\Requests\Country\CountryUpdateRequest;
use App\Http\Requests\Country\CountryViewRequest;
use App\Models\Countries;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    /**
     * Display index page of the resource.
     *
     * @param CountryViewRequest $request
     * @return void
     */
    public function index(CountryViewRequest $request)
    {
        return view('user.pages.country.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param CountryViewRequest $request
     * @return void
     */
    public function list(CountryViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');

            $list = Countries::withCount('provinces');
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.country.table', compact('list'))->render(),
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
     * Display a listing of the resource.
     *
     * @param CountryCreateRequest $request
     * @return void
     */
    public function insert(CountryCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Countries::create($data);
            save_log("Quốc gia #$new->name vừa mới được tạo", $data);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Tạo mới thành công',
                'type' => 'success',
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xãy ra!',
                'type' => 'error',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CountryUpdateRequest $request
     * @return void
     */
    public function update(CountryUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['status'] = isset($data['status']) && $data['status'] == Countries::STATUS_ACTIVE ? Countries::STATUS_ACTIVE : Countries::STATUS_BLOCKED;
            $new = Countries::findOrFail(request('id'));
            $new->update($data);
            save_log("Quốc gia #$new->name vừa mới được cập nhật", $data);
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
     * @param CountryDeleteRequest $request
     * @return void
     */
    public function delete(CountryDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Countries::findOrFail(request('id'));
            $new->delete();
            save_log("Quốc gia #$new->name vừa mới bị xóa", $new);
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
     * Display the specified resource.
     *
     * @param [type] $id
     * @param CountryViewRequest $request
     * @return void
     */
    public function detail($id, CountryViewRequest $request)
    {
        $data = Countries::withCount('provinces')->findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.country.show', compact('data'))->render();
        }
        return view('user.pages.country.detail', compact('data'));
    }
}
