<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationDetail extends Model
{
    use HasFactory;
    protected $table = 'destination_details';
    protected $fillable = [
        'destination_id',
        'name',
        'slug',
        'content',
        'images',
        'description',
        'time_public',
        'time_created',
        'admin_id',
        'status',
        'numering',
        'tags'
    ];
    protected $hidden = [];
    protected $casts = [
        'destination_id' => 'integer',
        'admin_id' => 'integer',    
        'numering' => 'integer', 
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