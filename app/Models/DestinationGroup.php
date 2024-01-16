<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->numering = $model->numering ?? self::getOrder();
        });
        self::created(function ($model) {
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
            // delete background
        });
    }

    const TYPE_NATIONAL = 'national';
    const TYPE_LOCAL = 'local';

    public static function get_type($type = '')
    {
        $_status = [
            self::TYPE_NATIONAL => ['Quốc tế', 'success'],
            self::TYPE_LOCAL => ['Trong nước', 'danger'],
        ];
        return $type == '' ? $_status : $_status["$type"];
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
