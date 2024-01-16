<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tour extends Model
{
    use HasFactory;
    protected $table = 'tours';

    protected $fillable = [
        'group_id',
        'country_id',
        'province_id',
        'slug',
        'code',
        'name',
        'description',
        'price',
        'currency',
        'background',
        'duration',
        'content',
        'schedule_file',
        'include',
        'exclude',
        'term',
        'notice',
        'status'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? Str::uuid();
            $model->slug = $model->slug ?? Str::slug('name');
            $model->currency = $model->currency ?? 'VND';
            $model->status = $model->status ?? self::STATUS_ACTIVE;
        });
        self::created(function ($model) {
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
            // delete background
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

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('tours.slug', $slug);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('tours.code', $code);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('tours.status', $status);
    }

    public function scopeGroupId($query, $group_id)
    {
        return $query->where('tours.group_id', $group_id);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'group_id', 'id');
    }
}
