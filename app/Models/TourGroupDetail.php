<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGroupDetail extends Model
{
    use HasFactory;
    protected $table = 'tour_group_details';

    protected $fillable = [
        'tour_id',
        'group_id'
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

    public function scopeTourId($query, $tour_id)
    {
        return $query->where('tour_group_details.tour_id', $tour_id);
    }

    public function scopeGroupId($query, $group_id)
    {
        return $query->where('tour_group_details.group_id', $group_id);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function group()
    {
        return $this->belongsTo(TourGroup::class, 'group_id');
    }
}
