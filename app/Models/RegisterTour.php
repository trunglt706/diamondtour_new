<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterTour extends Model
{
    use HasFactory;
    protected $table = 'register_tours';

    protected $fillable = [
        'code',
        'phone',
        'name',
        'status',
        'adults',
        'children',
        'other',
        'content'
    ];

    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->status = $model->status ?? self::STATUS_BLOCKED;
            $model->code = $model->code ?? generateRandomString();
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
            self::STATUS_ACTIVE => ['Đã duyệt', 'success'],
            self::STATUS_BLOCKED => ['Chưa duyệt', 'dark'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('register_tours.code', $code);
    }

    public function scopeOfPhone($query, $phone)
    {
        return $query->where('register_tours.phone', $phone);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('register_tours.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('register_tours.name', 'LIKE', "%$search%")
                ->orWhere('register_tours.phone', 'LIKE', "%$search%")
                ->orWhere('register_tours.code', 'LIKE', "%$search%");
        });
    }
}
