<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Setting\SettingUpdateRequest;
use App\Http\Requests\User\Setting\SettingViewRequest;
use App\Models\Images;
use App\Models\Setting;
use App\Models\SettingGroup;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    protected $dir;

    public function __construct()
    {
        $this->dir = 'uploads/setting';
    }

    /**
     * Display the index page of the resource.
     *
     * @param SettingViewRequest $request
     * @return void
     */
    public function index(SettingViewRequest $request)
    {
        $type = request('type', 'seo');
        $data = [
            'groups' => SettingGroup::ofStatus(SettingGroup::STATUS_ACTIVE)->orderBy('numering', 'asc')->select('code', 'name', 'icon', 'id')->get(),
            'group' => SettingGroup::with('settings')->ofCode($type)->ofStatus(SettingGroup::STATUS_ACTIVE)->firstOrFail()
        ];
        return view('user.pages.setting.index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingUpdateRequest $request
     * @return void
     */
    public function update(SettingUpdateRequest $request)
    {
        $data = $request->all();
        try {
            $lang = !is_null($data['lang']) ? $data['lang'] : '';
            $value = $lang == '' ? 'value' : 'value_' . $lang;
            DB::beginTransaction();
            $group = SettingGroup::ofCode($data['type'])->first();
            // get setting of group
            $settings = Setting::groupId($group->id)->get();
            $checkbox = [];
            foreach ($settings as $setting) {
                if (request()->has($setting->code)) {
                    switch ($setting->type) {
                        case Setting::TYPE_FILE:
                            if (request()->hasFile($setting->code)) {
                                $file = request()->file($setting->code);
                                // delete old image
                                delete_file($setting->value);
                                $data['value'] = store_file($file, $this->dir, false, 900);
                            }
                            break;
                        case Setting::TYPE_IMAGES:
                            if (request()->hasFile($setting->code)) {
                                foreach (request()->file($setting->code) as $file) {
                                    Images::create([
                                        'code' => $setting->code,
                                        'url' => store_file($file, $this->dir, false, 900)
                                    ]);
                                }
                            }
                            break;
                        case Setting::TYPE_CHECK_BOX:
                            if (request($setting->code) == 'on') {
                                array_push($checkbox, $setting->id);
                                $data['value'] = 1;
                            }
                            break;
                        default:
                            $data['value'] = trim(request($setting->code));
                            break;
                    }
                    $setting->$value = $data['value'];
                    $setting->save();
                }
            }
            Setting::groupId($group->id)->ofType(Setting::TYPE_CHECK_BOX)->whereNotIn('id', $checkbox)->update(['value' => 0]);
            save_log("Danh sách cấu hình thuộc danh mục #$group->name vừa mới được cập nhật", $data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            showLog($th);
            return redirect()->back()->with('error', 'Cập nhật thất bại!');
        }
    }

    /**
     * Swap image numering.
     *
     * @return void
     */
    public function swapImage()
    {
        $draggedIndex = Images::find(request('draggedId'));
        $targetIndex = Images::find(request('targetId'));

        $tmp_targetIndex = $draggedIndex->numering;
        $draggedIndex->numering = $targetIndex->numering;
        $draggedIndex->save();

        $targetIndex->numering = $tmp_targetIndex;
        $targetIndex->save();
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công',
            'type' => 'success',
        ]);
    }
}
