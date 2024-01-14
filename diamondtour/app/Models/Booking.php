<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    protected $fillable = [
        'code',
        'name',
        'phone',
        'date_from',
        'date_to',
        'total_adult',
        'total_children',
        'content',
        'description',
        'status'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? Str::uuid();
            $model->total_adult = $model->total_adult ?? 1;
            $model->total_children = $model->total_children ?? 0;
            $model->status = $model->status ?? self::STATUS_BLOCKED;
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

    public function scopeOfCode($query, $code)
    {
        return $query->where('bookings.code', $code);
    }

    public function scopeOfPhone($query, $phone)
    {
        return $query->where('bookings.phone', $phone);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('bookings.status', $status);
    }
}
