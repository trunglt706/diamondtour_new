<?php

namespace App\Http\Controllers;

use App\Http\Requests\Province\ProvinceCreateRequest;
use App\Http\Requests\Province\ProvinceDeleteRequest;
use App\Http\Requests\Province\ProvinceUpdateRequest;
use App\Http\Requests\Province\ProvinceViewRequest;
use App\Models\Countries;
use Illuminate\Support\Facades\DB;
use App\Models\Province;

class ProvinceController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    /**
     * Display the index page of the resource.
     *
     * @param ProvinceViewRequest $request
     * @return void
     */
    public function index(ProvinceViewRequest $request)
    {
        $country_id = request('country_id', '');
        $country = Countries::find($country_id);
        return view('user.pages.province.index', compact('country'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param ProvinceViewRequest $request
     * @return void
     */
    public function list(ProvinceViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $search = request('search', '');
            $country_id = request('country_id', '');

            $list = Province::query();
            $list = $country_id != '' ? $list->countryId($country_id) : $list;
            $list = $search != '' ? $list->where('name', 'LIKE', "%$search%") : $list;
            $list = $list->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.province.table', compact('list'))->render(),
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
     * @param ProvinceCreateRequest $request
     * @return void
     */
    public function insert(ProvinceCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Province::create($data);
            save_log("Khu vực #$new->name vừa mới được tạo", $data);
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
     * @param ProvinceUpdateRequest $request
     * @return void
     */
    public function update(ProvinceUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Province::findOrFail(request('id'));
            $new->update($data);
            save_log("Khu vực #$new->name vừa mới được cập nhật", $data);
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
     * @param ProvinceDeleteRequest $request
     * @return void
     */
    public function delete(ProvinceDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = Province::findOrFail(request('id'));
            $new->delete();
            save_log("Khu vực #$new->name vừa mới bị xóa", $new);
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
     * @param ProvinceViewRequest $request
     * @return void
     */
    public function detail($id, ProvinceViewRequest $request)
    {
        $data = Province::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.province.show', compact('data'))->render();
        }
        return view('user.pages.province.detail', compact('data'));
    }
}
