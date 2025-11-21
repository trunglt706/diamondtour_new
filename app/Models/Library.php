<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Library extends Model
{
    use HasFactory;
    protected $table = 'libraries';

    protected $fillable = [
        'group_id',
        'name',
        'image',
        'status',
        'important',
        'numering',
        'type',
        'name_en',
        'name_ch',
        'like_total',
        'view_total',
        'extension'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->important = $model->important ?? false;
            $model->numering = $model->numering ?? self::getOrder($model->group_id, $model->type);
            $model->name_en = $model->name_en ?? $model->name;
            $model->name_ch = $model->name_ch ?? $model->name;
            $model->extension = $model->extension ?? 'photo';
        });
        self::created(function ($model) {
            Cache::flush();
        });
        self::updated(function ($model) {
            Cache::flush();
        });
        self::deleted(function ($model) {
            Cache::flush();
            if ($model->image) {
                delete_file($model->image);
            }
        });
    }

    const EXTENSION_PHOTO = 'photo';
    const EXTENSION_VIDEO = 'video';

    const TYPE_LIBRARY = 'library';
    const TYPE_TOUR = 'tour';

    const IMPORTANT = 1;
    const NONE_IMPORTANT = 0;

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_extension($extension = '')
    {
        $_status = [
            self::EXTENSION_PHOTO => ['Hình ảnh', 'success'],
            self::EXTENSION_VIDEO => ['Video', 'danger'],
        ];
        return $extension == '' ? $_status : $_status["$extension"];
    }

    public static function get_important($status = '')
    {
        $_status = [
            self::IMPORTANT => ['Ưu tiên', 'success'],
            self::NONE_IMPORTANT => ['Không ưu tiên', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã bị khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeType($query, $type)
    {
        return $query->where('libraries.type', $type);
    }

    public function scopeGroupId($query, $group_id)
    {
        return $query->where('libraries.group_id', $group_id);
    }

    public function scopeOfImportant($query, $important)
    {
        return $query->where('libraries.important', $important);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('libraries.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('libraries.name', 'LIKE', "%$search%");
        });
    }

    public function group()
    {
        return $this->belongsTo(LibraryGroup::class, 'group_id');
    }

    public static function getOrder($group_id, $type)
    {
        $max = Library::groupId($group_id)->type($type)->max('numering') ?? 0;
        return $max + 1;
    }
}
