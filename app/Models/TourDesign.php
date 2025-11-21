<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDesign extends Model
{
    use HasFactory;
    protected $table = 'tour_designs';

    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'age',
        'with_people',
        'day_start',
        'total_adult',
        'total_children',
        'infomation',
        'status',
    ];

    protected $hidden = [];

    protected $casts = [];

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
}
