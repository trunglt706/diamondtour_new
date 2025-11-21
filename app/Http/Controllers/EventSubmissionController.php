<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventSubmission\EventSubmissionCreateRequest;
use App\Http\Requests\EventSubmission\EventSubmissionDeleteRequest;
use App\Http\Requests\EventSubmission\EventSubmissionUpdateRequest;
use App\Http\Requests\EventSubmission\EventSubmissionViewRequest;
use App\Models\Events;
use App\Models\EventSubmissions;
use Illuminate\Support\Facades\DB;

class EventSubmissionController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/event_submission';
    }

    /**
     * Display a listing of the resource.
     *
     * @param EventSubmissionViewRequest $request
     * @return void
     */
    public function index(EventSubmissionViewRequest $request)
    {
        $event = Events::findOrFail(request('event_id', ''));
        $data = [
            'event' => $event,
            'status' => EventSubmissions::get_status()
        ];
        return view('user.pages.event_submission.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param EventSubmissionViewRequest $request
     * @return void
     */
    public function list(EventSubmissionViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');
            $event_id = request('event_id', '');

            $list = EventSubmissions::query();
            $list = $event_id != '' ? $list->eventId($event_id) : $list;
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.event_submission.table', compact('list'))->render(),
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
     * Store a newly created resource in storage.
     *
     * @param EventSubmissionCreateRequest $request
     * @return void
     */
    public function insert(EventSubmissionCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new = EventSubmissions::create($data);
            save_log("Bài dự thi #$new->name vừa mới được tạo", $data);
            DB::commit();
            if (request()->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Tạo mới thành công',
                    'type' => 'success',
                ]);
            }
            return redirect()->back()->with('success', 'Tạo mới thành công');
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
     * Update the specified resource in storage.
     *
     * @param EventSubmissionUpdateRequest $request
     * @return void
     */
    public function update(EventSubmissionUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = EventSubmissions::findOrFail(request('id'));
            if (request()->hasFile('image')) {
                delete_file($new->image);
                $file = request()->file('image');
                $data['image'] = store_file($file, $this->dir, false, 900);
            }
            $new->update($data);
            save_log("Bài dự thi #$new->name vừa mới được cập nhật", $data);
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
     * @param EventSubmissionDeleteRequest $request
     * @return void
     */
    public function delete(EventSubmissionDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $new = EventSubmissions::findOrFail(request('id'));
            $new->delete();
            save_log("Bài dự thi #$new->name vừa mới bị xóa", $new);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Xóa thành công',
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
     * Display the specified resource.
     *
     * @param [type] $id
     * @param EventSubmissionViewRequest $request
     * @return void
     */
    public function detail($id, EventSubmissionViewRequest $request)
    {
        $data = EventSubmissions::findOrFail($id);
        $status = EventSubmissions::get_status($data->status);
        return view('user.pages.event_submission.detail', compact('data', 'status'));
    }

    /**
     * Display the specified resource for editing.
     *
     * @param [type] $id
     * @param EventSubmissionViewRequest $request
     * @return void
     */
    public function edit($id, EventSubmissionViewRequest $request)
    {
        $data = EventSubmissions::findOrFail($id);
        $other = [
            'status' => EventSubmissions::get_status(),
        ];
        return view('user.pages.event_submission.edit', compact('data', 'other'));
    }

    /**
     * Display the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $data['status'] = EventSubmissions::get_status();
        return view('user.pages.event_submission.create', compact('data'));
    }
}
