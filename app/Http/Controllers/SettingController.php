<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Setting\SettingUpdateRequest;
use App\Http\Requests\User\Setting\SettingViewRequest;
use App\Models\Setting;
use App\Models\SettingGroup;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class SettingController extends Controller
{
    protected $dir;

    public function __construct()
    {
        $this->dir = 'uploads/setting/';
    }

    public function index(SettingViewRequest $request)
    {
        return view('user.pages.setting.index');
    }

    public function update(SettingUpdateRequest $request)
    {
        $data = $request->all();
        try {
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
                                $name_random = time() . generateRandomString(5);
                                $filename = $name_random . '.' . $file->getClientOriginalExtension();
                                $path = $this->dir . $filename;
                                if (!File::exists($this->dir)) {
                                    File::makeDirectory($this->dir, $mode = 0777, true, true);
                                }
                                Image::make($file)->save($path);

                                // delete old image
                                File::delete($setting->value);
                                $data['value'] = $path;
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
                    $setting->value = $data['value'];
                    $setting->save();
                }
            }
            Setting::groupId($group->id)->ofType(Setting::TYPE_CHECK_BOX)->whereNotIn('id', $checkbox)->update(['value' => 0]);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            showLog($th);
            return redirect()->back()->with('error', 'Cập nhật thất bại!');
        }
    }
}
