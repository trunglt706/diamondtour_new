<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingGroup extends Model
{
    use HasFactory;
    protected $table = 'setting_groups';

    protected $fillable = [
        'code',
        'name',
        'icon',
        'numering',
        'status'
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->numering = $model->numering ?? self::getOrder();
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

    public function scopeOfStatus($query, $status)
    {
        return $query->where('setting_groups.status', $status);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('setting_groups.code', $code);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class, 'group_id', 'id')->where('status', self::STATUS_ACTIVE);
    }

    public function settingAll()
    {
        return $this->hasMany(Setting::class, 'group_id', 'id');
    }

    public static function getOrder()
    {
        $max = SettingGroup::max('numering') ?? 0;
        return $max + 1;
    }
}
