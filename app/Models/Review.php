<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';

    protected $fillable = [
        'destination_id',
        'code',
        'name',
        'important',
        'content',
        'status',
        'vendor',
        'user_name',
        'user_avatar'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->status = $model->status ?? self::STATUS_ACTIVE;
        });
        self::created(function ($model) {
            Cache::flush();
        });
        self::updated(function ($model) {
            Cache::flush();
        });
        self::deleted(function ($model) {
            Cache::flush();
            if ($model->user_avatar) {
                delete_file($model->user_avatar);
            }
        });
    }

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    const IMPORTANT_YES = 1;
    const IMPORTANT_NO = 0;

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
        return $query->where('reviews.code', $code);
    }

    public function scopeDestinationId($query, $destination_id)
    {
        return $query->where('reviews.destination_id', $destination_id);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('reviews.status', $status);
    }

    public function scopeOfImportant($query, $important)
    {
        return $query->where('reviews.important', $important);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('reviews.code', 'LIKE', "%$search%")
                ->orWhere('reviews.name', 'LIKE', "%$search%");
        });
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}
