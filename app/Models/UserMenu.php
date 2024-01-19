<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class UserMenu extends Model
{
    use HasFactory;
    protected $table = 'user_menus';

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
            Cache::forget(CACHE_MENU_USER);
        });
        self::updated(function ($model) {
            Cache::forget(CACHE_MENU_USER);
        });
        self::deleted(function ($model) {
            Cache::forget(CACHE_MENU_USER);
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
        return $query->where('user_menus.parent_id', $parent_id);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('user_menus.code', $code);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('user_menus.status', $status);
    }

    public static function  getOrder($parent_id)
    {
        $max = UserMenu::parentId($parent_id)->max('numering') ?? 0;
        return $max + 1;
    }

    public function parent()
    {
        return $this->belongsTo(UserMenu::class, 'parent_id');
    }

    public function menus()
    {
        return $this->hasMany(UserMenu::class, 'parent_id', 'id')->ofStatus(UserMenu::STATUS_ACTIVE)->orderBy('numering', 'asc');
    }
}
