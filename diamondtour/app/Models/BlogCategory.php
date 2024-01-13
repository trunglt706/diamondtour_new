<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table = 'blog_categories';
    protected $fillable = [
        'name',
        'image',
        'description',
        'slug',
        'status'
    ];
    protected $hidden = [];
    protected $casts = [
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
        return $query->where('blog_categories.status', $status);
    }
    
}