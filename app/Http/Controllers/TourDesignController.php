<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\TourDesign\TourDesignDeleteRequest;
use App\Http\Requests\User\TourDesign\TourDesignUpdateRequest;
use App\Http\Requests\User\TourDesign\TourDesignViewRequest;
use App\Models\DesignTour;
use Illuminate\Support\Facades\DB;

class TourDesignController extends Controller
{
    protected $limit_default;

    public function __construct()
    {
        $this->limit_default = 10;
    }

    /**
     * Display the index page of the resource.
     *
     * @param TourDesignViewRequest $request
     * @return void
     */
    public function index(TourDesignViewRequest $request)
    {
        $data = [
            'status' => DesignTour::get_status()
        ];
        return view('user.pages.tour.design.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param TourDesignViewRequest $request
     * @return void
     */
    public function list(TourDesignViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');
            $country_id = request('country_id', '');
            $tour_group_id = request('tour_group_id', '');
            $someone_id = request('someone_id', '');
            $service_id = request('service_id', '');
            $age_id = request('age_id', '');
            $place_id = request('place_id', '');
            $balance_id = request('balance_id', '');
            $style_id = request('style_id', '');

            $list = DesignTour::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $country_id != '' ? $list->countryId($country_id) : $list;
            $list = $tour_group_id != '' ? $list->tourGroupId($tour_group_id) : $list;
            $list = $someone_id != '' ? $list->someoneId($someone_id) : $list;
            $list = $service_id != '' ? $list->serviceId($service_id) : $list;
            $list = $age_id != '' ? $list->ageId($age_id) : $list;
            $list = $place_id != '' ? $list->placeId($place_id) : $list;
            $list = $balance_id != '' ? $list->balanceId($balance_id) : $list;
            $list = $style_id != '' ? $list->styleId($style_id) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.tour.design.table', compact('list'))->render(),
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
     * Update the specified resource in storage.
     *
     * @param TourDesignUpdateRequest $request
     * @return void
     */
    public function update(TourDesignUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = DesignTour::findOrFail(request('id'));
            $new->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            showLog($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xãy ra!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TourDesignDeleteRequest $request
     * @return void
     */
    public function delete(TourDesignDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = DesignTour::findOrFail(request('id'));
            $new->delete();
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
     * @param TourDesignViewRequest $request
     * @return void
     */
    public function detail($id, TourDesignViewRequest $request)
    {
        $data = DesignTour::findOrFail($id);
        return view('user.pages.tour.design.detail', compact('data'));
    }
}
