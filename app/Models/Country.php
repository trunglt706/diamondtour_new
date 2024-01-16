<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $fillable = [
        'code',
        'name',
        'is_default',
        'status'
    ];
    protected $hidden = [];
    protected $casts = [
        'is_default' => 'boolean',
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
    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public function scopeOfStatus($query, $status)
    {
        return $query->where('blogs.status', $status);
    }
}
