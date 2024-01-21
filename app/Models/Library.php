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
        'numering'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->important = $model->important ?? false;
            $model->numering = $model->numering ?? self::getOrder($model->group_id);
        });
        self::created(function ($model) {
            Cache::forget(CACHE_LIBRARY . '-' . $model->group_id);
        });
        self::updated(function ($model) {
            Cache::forget(CACHE_LIBRARY . '-' . $model->group_id);
        });
        self::deleted(function ($model) {
            Cache::forget(CACHE_LIBRARY . '-' . $model->group_id);
            // delete image
        });
    }

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã bị khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
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

    public static function getOrder($group_id)
    {
        $max = Library::groupId($group_id)->max('numering') ?? 0;
        return $max + 1;
    }
}
