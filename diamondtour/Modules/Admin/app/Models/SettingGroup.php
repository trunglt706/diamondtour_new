<?php

namespace Modules\Admin\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Database\factories\SettingGroupFactory;

class SettingGroup extends Model
{
    use HasFactory;
    protected $table = 'setting_groups';
    protected $fillable = [
        'code',
        'name',
        'value',
        'description',
        'type',
        'data_json',
        'numering',
        'status'
    ];
    protected $hidden = [];
    protected $casts = [
        'group_id' => 'integer',
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
    
}