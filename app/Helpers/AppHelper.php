<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as ResHTTP;

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
    function uploadToS3($module, $fileContent, $type = 'file', $disk = 'public')
    {
        $folder = "uploads/$module";
        $path = '';
        // Store the file in S3
        if ($type == 'base64') {
            list($extension, $content) = explode(';', $fileContent);
            $tmpExtension = explode('/', $extension);
            preg_match('/.([0-9]+) /', microtime(), $m);
            $filename = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
            $content = explode(',', $content)[1];
            $path = "$folder/$filename";
            Storage::disk($disk)->put($path, base64_decode($content), 'public');
        } else {
            $filename = $fileContent->getClientOriginalName();
            $newName = str_replace(' ', '-', $filename);
            $path = "$folder/$newName";
            Storage::disk($disk)->put($path, file_get_contents($fileContent), 'public');
        }
        return "storage/$path";
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
if (!defined('MAX_FILE_SIZE_UPLOAD')) {
    define('MAX_FILE_SIZE_UPLOAD', (5 * 1024));
}
