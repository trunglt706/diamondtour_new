<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    protected $table = 'libraries';

    protected $fillable = [
        'group_id',
        'name',
        'link',
        'description',
        'images',
        'status',
        'created_by',
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
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

    public function scopeGroupId($query, $group_id)
    {
        return $query->where('libraries.group_id', $group_id);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('libraries.status', $status);
    }

    public function group()
    {
        return $this->belongsTo(LibraryGroup::class, 'group_id');
    }
}