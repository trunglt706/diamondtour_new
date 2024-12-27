<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class TourGroup extends Model
{
    use HasFactory;
    protected $table = 'tour_groups';

    protected $fillable = [
        'slug',
        'code',
        'name',
        'image',
        'status',
        'description',
        'name_en',
        'name_ch',
        'numering',
        'description_en',
        'description_ch',
        'view_total',
        'like_total',
        'starts',
        'days',
        'personals',
        'country_id',
        'video_name',
        'video_status',
        'video_url',
        'video_image',
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->slug = $model->slug ?? Str::slug($model->name);
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->numering = $model->numering ?? 0;
            $model->name_en = $model->name_en ?? $model->name;
            $model->name_ch = $model->name_ch ?? $model->name;
            $model->description_en = $model->description_en ?? $model->description;
            $model->description_ch = $model->description_ch ?? $model->description;
            $model->starts = $model->starts ?? 5;
            $model->days = $model->days ?? 0;
            $model->personals = $model->personals ?? 0;
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
            if ($model->video_image) {
                delete_file($model->video_image);
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
        return $query->where('tour_groups.code', $code);
    }

    public function scopeCountryId($query, $country_id)
    {
        return $query->where('tour_groups.country_id', $country_id);
    }

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('tour_groups.slug', $slug);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('tour_groups.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('tour_groups.code', 'LIKE', "%$search%")
                ->orWhere('tour_groups.name', 'LIKE', "%$search%");
        });
    }

    public function tours()
    {
        return $this->hasMany(Tour::class, 'group_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }

    public static function getOrder()
    {
        $max = TourGroup::max('numering') ?? 0;
        return $max + 1;
    }
}
