<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignTour extends Model
{
    use HasFactory;
    protected $table = 'design_tours';

    protected $fillable = [];

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
}
