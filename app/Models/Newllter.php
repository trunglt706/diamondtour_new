<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Newllter extends Model
{
    use HasFactory;
    protected $table = 'newllters';

    protected $fillable = [
        'code',
        'email',
        'device',
        'status'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->device = $model->device ?? json_encode([
                'ip' => request()->ip(),
                'device' => request()->userAgent(),
            ]);
            $model->code = $model->code ?? Str::uuid();
            $model->status = $model->status ?? self::STATUS_BLOCKED;
        });
        self::created(function ($model) {
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
        });
    }

    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 0;

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
        return $query->where('newllters.code', $code);
    }

    public function scopeOfEmail($query, $email)
    {
        return $query->where('newllters.email', $email);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('newllters.status', $status);
    }
}
