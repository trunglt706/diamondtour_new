<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';

    protected $fillable = [
        'code',
        'numering',
        'name',
        'link',
        'icon',
        'parent_id',
        'status',
        'images',
        'active',
    ];

    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $parent_id = $model->parent_id ?? 0;
            $model->parent_id = $parent_id;
            $model->numering = self::getOrder($parent_id);
            $model->status = $model->status ?? self::STATUS_ACTIVE;
        });
        self::created(function ($model) {
            Cache::forget(CACHE_MENU);
        });
        self::updated(function ($model) {
            Cache::forget(CACHE_MENU);
        });
        self::deleted(function ($model) {
            Cache::forget(CACHE_MENU);
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

    public function scopeParentId($query, $parent_id)
    {
        return $query->where('menus.parent_id', $parent_id);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('menus.code', $code);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('menus.status', $status);
    }

    public static function  getOrder($parent_id)
    {
        $max = Menu::parentId($parent_id)->max('numering') ?? 0;
        return $max + 1;
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->ofStatus(Menu::STATUS_ACTIVE)->orderBy('numering', 'asc');
    }
}
