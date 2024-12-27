<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';

    protected $fillable = [
        'tour_id',
        'code',
        'name',
        'description',
        'status',
        'image',
        'numering'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->numering = $model->numering ?? self::getOrder($model->tour_id);
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

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('schedules.code', 'LIKE', "%$search%")
                ->orWhere('schedules.name', 'LIKE', "%$search%");
        });
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function details()
    {
        return $this->hasMany(ScheduleDetal::class, 'schedule_id', 'id')->select('id', 'name', 'description', 'schedule_id');
    }

    public static function getOrder($tour_id)
    {
        $max = Schedule::tourId($tour_id)->max('numering') ?? 0;
        return $max + 1;
    }
}
