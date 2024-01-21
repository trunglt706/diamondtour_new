<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LibraryGroup extends Model
{
    use HasFactory;
    protected $table = 'library_groups';

    protected $fillable = [
        'slug',
        'name',
        'description',
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
            $model->slug = $model->slug ?? Str::slug('name');
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->important = $model->important ?? false;
            $model->numering = $model->numering ?? self::getOrder();
        });
        self::created(function ($model) {
            Cache::forget(CACHE_LIBRARY);
        });
        self::updated(function ($model) {
            Cache::forget(CACHE_LIBRARY);
        });
        self::deleted(function ($model) {
            Cache::forget(CACHE_LIBRARY);
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

    public function scopeOfImportant($query, $important)
    {
        return $query->where('library_groups.important', $important);
    }

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('library_groups.slug', $slug);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('library_groups.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('library_groups.name', 'LIKE', "%$search%");
        });
    }

    public function libraries()
    {
        return $this->hasMany(Library::class, 'group_id', 'id');
    }

    public static function getOrder()
    {
        $max = LibraryGroup::max('numering') ?? 0;
        return $max + 1;
    }
}
