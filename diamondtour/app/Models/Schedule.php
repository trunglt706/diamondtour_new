<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';

    protected $fillable = [
        'tour_id',
        'code',
        'name',
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
            $model->status = $model->status ?? self::STATUS_ACTIVE;
        });
        self::created(function ($model) {
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
        });
    }

    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 0;

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
        return $query->where('schedules.code', $code);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('schedules.status', $status);
    }

    public function scopeTourId($query, $tour_id)
    {
        return $query->where('schedules.tour_id', $tour_id);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
