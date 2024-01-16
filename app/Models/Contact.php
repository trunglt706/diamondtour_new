<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'question',
        'comment',
        'status'
    ];
    protected $hidden = [];
    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
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
            self::STATUS_UN_ACTIVE => ['Chưa kích hoạt', 'secondary'],
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã bị khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('contacts.status', $status);
    }

    public function scopeOfCode($query, $status)
    {
        return $query->where('contacts.status', $status);
    }

    public function scopeOfEmail($query, $email)
    {
        return $query->where('contacts.email', $email);
    }

    public function scopeOfPhone($query, $phone)
    {
        return $query->where('contacts.phone', $phone);
    }
}
