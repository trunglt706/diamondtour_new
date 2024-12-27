<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Events extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'slug',
        'title',
        'description',
        'content',
        'image',
        'background',
        'status',
        'script',
        'home',
        'view_total',
        'like_total',
        'date'
    ];
    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->slug = $model->slug ?? Str::slug($model->title);
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->important = $model->important ?? 0;
            $model->home = $mode->home ?? false;
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
            if ($model->background) {
                delete_file($model->background);
            }
        });
    }

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfHome($query, $home)
    {
        return $query->where('events.home', (int)$home);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('events.status', $status);
    }

    public function scopeOfDate($query, $date)
    {
        return $query->whereDate('events.date', $date);
    }

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('events.slug', $slug);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('events.title', 'LIKE', "%$search%")
                ->orWhere('events.description', 'LIKE', "%$search%");
        });
    }

    public function submitssions()
    {
        return $this->hasMany(EventSubmissions::class, 'event_id', 'id');
    }

    public function submitssionActive()
    {
        return $this->hasMany(EventSubmissions::class, 'event_id', 'id')->where('event_submissions.status', EventSubmissions::STATUS_ACTIVE);
    }
}
