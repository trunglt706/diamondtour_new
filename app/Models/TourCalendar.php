<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TourCalendar extends Model
{
    use HasFactory;
    protected $table = 'tour_calendars';

    protected $fillable = [
        'tour_id',
        'status',
        'start',
        'end',
        'price',
        'description',
        'empty',
        'display'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->display = $model->display ?? true;
        });
        self::created(function ($model) {
            Cache::flush();
        });
        self::updated(function ($model) {
            Cache::flush();
        });
        self::deleted(function ($model) {
            Cache::flush();
        });
    }

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Đang nhận khách', 'success'],
            self::STATUS_BLOCKED => ['Ngưng nhận khách', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfDisplay($query, $display)
    {
        return $query->where('tour_calendars.display', $display);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('tour_calendars.status', $status);
    }

    public function scopeTourId($query, $tour_id)
    {
        return $query->where('tour_calendars.tour_id', $tour_id);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('tour_calendars.description', 'LIKE', "%$search%");
        });
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
