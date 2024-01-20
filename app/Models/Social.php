<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $table = 'socials';

    protected $fillable = [
        'code',
        'name',
        'link',
        'icon',
        'status',
        'numering'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->numering = $model->numering ?? self::getOrder();
            $model->code = $model->code ?? generateRandomString();
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
        return $query->where('socials.code', $code);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('socials.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('socials.code', 'LIKE', "%$search%")
                ->orWhere('socials.name', 'LIKE', "%$search%");
        });
    }

    public static function getOrder()
    {
        $max = Social::max('numering') ?? 0;
        return $max + 1;
    }
}
