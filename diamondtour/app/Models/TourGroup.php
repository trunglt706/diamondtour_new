<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TourGroup extends Model
{
    use HasFactory;
    protected $table = 'tour_groups';

    protected $fillable = [
        'code',
        'name',
        'image',
        'status',
        'description'
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
            // delete image
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
        return $query->where('tour_groups.code', $code);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('tour_groups.status', $status);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class, 'group_id', 'id');
    }
}