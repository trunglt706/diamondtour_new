<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'cate_id',
        'name',
        'background',
        'images',
        'description',
        'day_created',
        'day_public',
        'status',
        'created_by',
        'tags',
        'tour_link'
    ];
    protected $hidden = [];
    protected $casts = [
        'cate_id' =>'integer',
        'day_created'=>'datetime',
        'day_public'=>'datetime',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];
    public static function boot(){
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
    //function and relationship
    
    public function scopeOfStatus($query, $status)
    {
        return $query->where('blogs.status', $status);
    }
}