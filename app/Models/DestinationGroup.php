<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class DestinationGroup extends Model
{
    use HasFactory;
    protected $table = 'destination_groups';

    protected $fillable = [
        'slug',
        'code',
        'name',
        'image',
        'type',
        'description',
        'numering',
        'name_en',
        'name_ch',
        'status',
        'description_en',
        'description_ch',
        'view_total',
        'like_total',
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

    const TYPE_NATIONAL = 'national';
    const TYPE_LOCAL = 'local';

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_type($type = '')
    {
        $_status = [
            self::TYPE_NATIONAL => ['Quốc tế', 'success'],
            self::TYPE_LOCAL => ['Trong nước', 'danger'],
        ];
        return $type == '' ? $_status : $_status["$type"];
    }

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã bị khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('destination_groups.type', $type);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('destination_groups.code', $code);
    }

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('destination_groups.slug', $slug);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('destination_groups.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('destination_groups.code', 'LIKE', "%$search%")
                ->orWhere('destination_groups.name', 'LIKE', "%$search%");
        });
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class, 'group_id', 'id');
    }

    public static function getOrder()
    {
        $max = DestinationGroup::max('numering') ?? 0;
        return $max + 1;
    }
}
