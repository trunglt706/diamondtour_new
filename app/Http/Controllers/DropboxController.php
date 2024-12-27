<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class DropboxController extends Controller
{
    private $disk_name = 'local';

    public function storage(): Filesystem
    {
        return Storage::disk($this->disk_name);
    }

    /**
     * xem tất cả các files
     */
    public function list()
    {
        return $this->storage()->allFiles();
    }

    /**
     * Lưu nội dung tập tin
     * $content: Nội dung file
     * $uri: Đường dẫn cần lưu tập tin
     */
    public function store($content, $uri)
    {
        $url = $content->store($uri, 'public');
        return $url;
    }

    /**
     * Lấy đường dẫn từ uri
     * $uri: Đường dẫn tương đối
     */
    public function url($uri)
    {
        try {
            return $this->storage()->url($uri);
        } catch (\Throwable $th) {
            return '';
        }
    }

    /**
     * Xóa danh sách uri
     * $uri: đường dẫn tương đối
     */
    public function delete($uri)
    {
        try {
            return $this->storage()->delete($uri);
        } catch (\Throwable $th) {
            showLog($th);
        }
    }
}
