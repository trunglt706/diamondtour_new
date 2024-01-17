<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Vanthao03596\HCVN\Models\Province;

class Destination extends Model
{
    use HasFactory;
    protected $table = 'destinations';

    protected $fillable = [
        'group_id',
        'country_id',
        'province_id',
        'slug',
        'code',
        'name',
        'description',
        'image',
        'content',
        'address',
        'important',
        'tags',
        'view_total',
        'like_total',
        'price',
        'status'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? Str::uuid();
            $model->slug = $model->code ?? Str::slug('name');
            $model->status = $model->status ?? self::STATUS_UN_ACTIVE;
            $model->important = $model->important ?? false;
        });
        self::created(function ($model) {
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
        });
    }

    const STATUS_UN_ACTIVE = 'un_active';
    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Chưa kích hoạt', 'secondary'],
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã bị khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeProvinceId($query, $province_id)
    {
        return $query->where('destinations.province_id', $province_id);
    }

    public function scopeCountryId($query, $country_id)
    {
        return $query->where('destinations.country_id', $country_id);
    }

    public function scopeGroupId($query, $group_id)
    {
        return $query->where('destinations.group_id', $group_id);
    }

    public function scopeOfImportant($query, $important)
    {
        return $query->where('destinations.important', $important);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('destinations.code', $code);
    }

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('destinations.slug', $slug);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('destinations.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('destinations.code', 'LIKE', "%$search%")
                ->orWhere('destinations.name', 'LIKE', "%$search%");
        });
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'destination_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(DestinationGroup::class, 'group_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
