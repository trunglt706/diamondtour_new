<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class QaGroup extends Model
{
    use HasFactory;
    protected $table = 'qa_groups';

    protected $fillable = [
        'name',
        'status',
        'numering',
        'name_en',
        'name_ch',
        'important'
    ];

    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->numering = $model->numering ?? self::getOrder();
            $model->important = $model->important ?? 0;
            $model->name_en = $model->name_en ?? $model->name;
            $model->name_ch = $model->name_ch ?? $model->name;
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

    const IS_IMPORTANT = 1;
    const IS_NOT_IMPORTANT = 0;

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã bị khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfImportant($query, $important)
    {
        return $query->where('qa_groups.important', $important);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('qa_groups.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('qa_groups.name', 'LIKE', "%$search%");
        });
    }

    public function qas()
    {
        return $this->hasMany(Qa::class, 'group_id', 'id');
    }

    public static function getOrder()
    {
        $max = QaGroup::max('numering') ?? 0;
        return $max + 1;
    }
}
