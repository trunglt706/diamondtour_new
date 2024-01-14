<?php

namespace Modules\Admin\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Database\factories\MenuFactory;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';

    protected $fillable = [
        'code',
        'numering',
        'name',
        'url',
        'icon',
        'parent_id',
        'status'
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
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
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

    public function scopeOfStatus($query, $status)
    {
        return $query->where('menus.status', $status);
    }

    public static function  getOrder($parent_id)
    {
        $max = Menu::parentId($parent_id)->max('nummering') ?? 0;
        return $max + 1;
    }
}