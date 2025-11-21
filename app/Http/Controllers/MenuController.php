<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menu\MenuUpdateRequest;
use App\Http\Requests\Menu\MenuViewRequest;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    protected $limit_default, $dir;

    public function __construct()
    {
        $this->limit_default = 10;
        $this->dir = 'uploads/menu';
    }

    /**
     * Display the menu index page.
     *
     * @param MenuViewRequest $request
     * @return void
     */
    public function index(MenuViewRequest $request)
    {
        return view('user.pages.setting.menu.index');
    }

    /**
     * Display a listing of the menus.
     *
     * @param MenuViewRequest $request
     * @return void
     */
    public function list(MenuViewRequest $request)
    {
        try {
            $limit = request('limit', $this->limit_default);
            $status = request('status', '');
            $search = request('search', '');

            $list = Menu::query();
            $list = $status != '' ? $list->ofStatus($status) : $list;
            $list = $search != '' ? $list->search($search) : $list;
            $list = $list->latest()->paginate($limit);
            return response()->json([
                'status' => true,
                'total' => $list->total(),
                'data' => view('user.pages.setting.menu.table', compact('list'))->render(),
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
     * Update an existing menu.
     *
     * @param MenuUpdateRequest $request
     * @return void
     */
    public function update(MenuUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            $new = Menu::findOrFail(request('id'));
            if (request()->hasFile('background')) {
                delete_file($new->background);
                $file = request()->file('background');
                $data['background'] = store_file($file, $this->dir, false, 1500);
            }
            if (request()->hasFile('images')) {
                $album = [];
                foreach (request()->file('images') as $file) {
                    array_push($album, store_file($file, $this->dir, false, 1500));
                }
                $old_album = $new->images ? json_decode($new->images) : [];
                foreach ($old_album as $old) {
                    delete_file($old);
                }
                $data['images'] = json_encode($album);
            }
            $new->update($data);
            DB::commit();
            save_log("Menu #$new->name vừa mới được cập nhật", $data);
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
     * Display the details of a specific menu.
     *
     * @param [type] $id
     * @param MenuViewRequest $request
     * @return void
     */
    public function detail($id, MenuViewRequest $request)
    {
        $data = Menu::findOrFail($id);
        if (request()->ajax()) {
            return view('user.pages.setting.menu.show', compact('data'))->render();
        }
        return view('user.pages.setting.menu.detail', compact('data'));
    }

    /**
     * Insert a new menu.
     *
     * @return void
     */
    public function insert()
    {
        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request()->hasFile('background')) {
                $file = request()->file('background');
                $data['background'] = store_file($file, $this->dir, false, 1500);
            }
            $new = Menu::create($data);
            save_log("Menu #$new->name vừa mới được tạo", $data);
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
}
