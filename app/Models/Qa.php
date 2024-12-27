<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Qa extends Model
{
    use HasFactory;
    protected $table = 'qas';

    protected $fillable = [
        'group_id',
        'code',
        'name',
        'description',
        'status',
        'name_en',
        'name_ch',
        'numering',
        'description_en',
        'description_ch'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->numering = $model->numering ?? self::getOrder();
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

    public function scopeGroupId($query, $group_id)
    {
        return $query->where('qas.group_id', $group_id);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('qas.code', $code);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('qas.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('qas.code', 'LIKE', "%$search%")
                ->orWhere('qas.name', 'LIKE', "%$search%");
        });
    }

    public function group()
    {
        return $this->belongsTo(QaGroup::class, 'group_id');
    }

    public static function getOrder()
    {
        $max = Qa::max('numering') ?? 0;
        return $max + 1;
    }
}
