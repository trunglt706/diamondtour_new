<?php

use App\Http\Controllers\Demo\TourController;
use App\Http\Controllers\DropboxController;
use App\Models\Images;
use App\Models\Social;
use App\Models\Tour;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as ResHTTP;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

// color

if (!defined('COLOR_PRIMARY')) {
    define('COLOR_PRIMARY', '#0d6efd');
}
if (!defined('COLOR_DANGER')) {
    define('COLOR_DANGER', '#dc3545');
}
if (!defined('COLOR_SUCCESS')) {
    define('COLOR_SUCCESS', '#198754');
}
if (!defined('COLOR_INFO')) {
    define('COLOR_INFO', '#0dcaf0');
}
if (!defined('COLOR_SECONDARY')) {
    define('COLOR_SECONDARY', '#6c757d');
}
if (!defined('COLOR_LIGHT')) {
    define('COLOR_LIGHT', '#f8f9fa');
}
if (!defined('COLOR_DARK')) {
    define('COLOR_DARK', '#212529');
}
if (!defined('COLOR_WARNING')) {
    define('COLOR_WARNING', '#ffc107');
}
if (!defined('COLORS')) {
    // get array color
    define('COLORS', [
        COLOR_PRIMARY => '#0d6efd',
        COLOR_DANGER => '#dc3545',
        COLOR_SUCCESS => '#198754',
        COLOR_INFO => '#0dcaf0',
        COLOR_SECONDARY => '#6c757d',
        COLOR_LIGHT => '#f8f9fa',
        COLOR_DARK => '#212529',
        COLOR_WARNING => '#ffc107'
    ]);
}
if (!function_exists('showLog')) {
    // show log by system
    function showLog(\Throwable $th)
    {
        Log::error([
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'message' => $th->getMessage()
        ]);
    }
}
if (!function_exists('generateRandomString')) {
    // generate code
    function generateRandomString($length = 10,  $is_number = false)
    {
        if ($is_number == true) {
            $length -= 1;
            return ($length > 0) ? random_int(1, 9) . substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length) : '';
        }
        return ($length > 0) ? substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length) : '';
    }
}
if (!function_exists('get_ip')) {
    // detect ip action
    function get_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        return $ipaddress;
    }
}
if (!function_exists('get_device')) {
    // detect device action
    function get_device()
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? '';
    }
}
if (!function_exists('get_phone_number')) {
    // get phone number with condition
    function get_phone_number($value, $condition = false)
    {
        if ($value) {
            return $condition ? Str::mask($value, '*', - (strlen($value)), (strlen($value) - 3)) : $value;
        }
        return '';
    }
}
if (!function_exists('mask_string')) {
    function mask_string($string, $length = null)
    {
        $length = $length ? $length : 3;
        return Str::of($string)->mask('*', $length);
    }
}
if (!function_exists('get_avatar_api')) {
    function get_avatar_api($name = '')
    {
        return 'https://ui-avatars.com/api/' . $name;
    }
}

if (!function_exists('uploadToS3')) {
    function uploadToS3($module, $fileContent)
    {
        $folder = "uploads/$module";
        $path = '';
        // Store the file in S3
        $filename = time() . '-' . $fileContent->getClientOriginalName();
        $newName = str_replace(' ', '-', $filename);
        $path = "$folder/$newName";
        Storage::put($path, file_get_contents($fileContent), 'public');
        return Storage::url($path);
    }
}
if (!function_exists('deleteFromS3')) {
    function deleteFromS3($path, $disk = 'public')
    {
        $file = str_replace('storage/', '', $path);
        return Storage::disk($disk)->delete($file);
    }
}

if (!function_exists('get_date_string')) {
    function get_date_string()
    {
        $from = now()->format('Y-m-d');
        $to = now()->subDays(30)->format('Y-m-d');
        return "$to to $from";
    }
}
if (!function_exists('check_active_menu')) {
    function check_active_menu($menus, $class = 'active')
    {
        return in_array(Route::currentRouteName(), $menus) ? $class : '';
    }
}
if (!function_exists('show_log_exception')) {
    function show_log_exception(\Throwable $th)
    {
        Log::error($th);
        return Response::json([
            'status' => ResHTTP::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'Có lỗi xãy ra, vui lòng thử lại sau!'
        ]);
    }
}

if (!function_exists('previousUrl')) {
    function previousUrl()
    {
        return url()->previous();
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        $array = explode('/', $date);
        return $array[2] . '-' . $array[1] . '-' . $array[0];
    }
}
if (!defined('MAX_FILE_SIZE_UPLOAD')) {
    define('MAX_FILE_SIZE_UPLOAD', (5 * 1024));
}

if (!function_exists('get_link_public')) {
    function get_link_public($full_link)
    {
        $url = str_replace(env('APP_URL') . '/', '', $full_link);
        return $url;
    }
}

if (!function_exists('get_total_days')) {
    function get_total_days($from, $to)
    {
        // Ngày bắt đầu
        $startDate = new DateTime($from);

        // Ngày kết thúc
        $endDate = new DateTime($to);

        // Tính hiệu giữa hai ngày
        $interval = $startDate->diff($endDate);

        // Lấy số ngày từ kết quả
        $totalDays = $interval->days + 1;
        return $totalDays;
    }
}

if (!function_exists('get_url')) {
    function get_url($uri, $storage = false)
    {
        $url = "";
        if ($storage) {
            $dropbox =  new DropboxController();
            $url =  $dropbox->url($uri);
        }
        $url =  $uri;
        return $url ? asset($url) : '';
        // return env('CDN_URL') . '/' . $uri;
    }
}

if (!function_exists('store_file')) {
    function store_file($file, $uri, $storage = false, $width = null, $height = null)
    {
        if ($storage) {
            $dropbox =  new DropboxController();
            return $dropbox->store($file, $uri);
        } else {
            $name_random = time() . generateRandomString(5);
            $filename = $name_random . '.webp';
            $path = $uri . '/' . $filename;
            if (!File::exists($uri)) {
                File::makeDirectory($uri, $mode = 0777, true, true);
            }
            if ($width && $height) {
                Image::make($file)->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path);
            } else {
                Image::make($file)->save($path);
            }
            return $path;
        }
    }
}

if (!function_exists('delete_file')) {
    function delete_file($uri, $storage = false)
    {
        if ($storage) {
            $dropbox =  new DropboxController();
            return $dropbox->delete($uri);
        }
        return File::delete($uri);
    }
}

if (!function_exists('CheckViewSession')) {
    function CheckViewSession($element, $model)
    {
        $key = 'viewed_' . $element; // Khóa session riêng cho bài viết
        $time = VIEW_TIME; // VIEW_TIME giây
        // Kiểm tra session đã tồn tại và thời gian chưa quá VIEW_TIME giây
        if (!Session::has($key) || (time() - Session::get($key)) > $time) {
            // Tăng lượt xem cho bài viết
            $model->view_total += 1;
            $model->save();

            // Cập nhật lại session với thời gian hiện tại
            Session::put($key, time());
        }
        return $model;
    }
}

if (!function_exists('CheckLikeSession')) {
    function CheckLikeSession($element, $model)
    {
        $key = 'liked_' . $element; // Khóa session riêng cho bài viết
        $time = VIEW_TIME; // VIEW_TIME giây
        // Kiểm tra session đã tồn tại và thời gian chưa quá VIEW_TIME giây
        if (!Session::has($key) || (time() - Session::get($key)) > $time) {
            // Tăng lượt xem cho bài viết
            $model->like_total += 1;
            $model->save();

            // Cập nhật lại session với thời gian hiện tại
            Session::put($key, time());
        }
        return $model;
    }
}

if (!function_exists('get_socials')) {
    function get_socials()
    {
        if (Cache::has('all_social')) {
            $data = Cache::get('all_social');
        } else {
            $data = Cache::remember('all_social', CACHE_TIME, function () {
                return Social::ofStatus(Social::STATUS_ACTIVE)->orderBy('numering', 'desc')->select('icon', 'link')->get();
            });
        }
        return $data;
    }
}

if (!function_exists('get_tour_group')) {
    function get_tour_group()
    {
        return TourController::tours();
    }
}

if (!function_exists('total_tour_by_season')) {
    function total_tour_by_season($season, $t = '')
    {
        $total = Tour::ofStatus(Tour::STATUS_ACTIVE)->ofSeason($season);
        if ($t != '') {
            $total = $total->ofType($t);
        }
        return $total->count() ?? 0;
    }
}

if (!function_exists('get_season_by_month')) {
    function get_season_by_month($month)
    {
        if (in_array($month, [4, 5, 6])) {
            return Tour::SEASON_HA;
        }
        if (in_array($month, [7, 8, 9])) {
            return Tour::SEASON_THU;
        }
        if (in_array($month, [10, 11, 12])) {
            return Tour::SEASON_DONG;
        }
        return Tour::SEASON_XUAN;
    }
}

if (!function_exists('get_next_season')) {
    function get_next_season($season)
    {
        $list = Tour::get_season();
        $keys = array_keys($list); // Lấy tất cả các khóa của mảng
        $index = array_search($season, $keys); // Tìm vị trí của giá trị hiện tại
        $nextIndex = ($index + 1) % count($list); // Tính vị trí của giá trị tiếp theo, quay vòng nếu cần
        return $keys[$nextIndex];
    }
}

if (!function_exists('get_current_season')) {
    function get_current_season()
    {
        $month = (int)date('m');
        return get_season_by_month($month);
    }
}

if (!function_exists('get_data_lang')) {
    function get_data_lang($data, $key)
    {
        $locale = \Config::get('app.locale');
        $tmp = $locale == 'vi' ? $key : $key . "_" . $locale;
        return $data->$tmp ?? $data->$key;
    }
}

if (!function_exists('get_image_from_codes')) {
    function get_image_from_codes($code)
    {
        return Images::ofCode($code)->orderBy('numering', 'desc')->select('url', 'id')->get();
    }
}

if (!function_exists('get_image_from_table')) {
    function get_image_from_table($table, $table_id)
    {
        return Images::ofTable($table)->tableId($table_id)->select('url', 'id')->get();
    }
}
