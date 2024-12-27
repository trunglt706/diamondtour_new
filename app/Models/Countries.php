<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Countries extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $fillable = [
        'code',
        'name',
        'status'
    ];
    protected $hidden = [];
    protected $casts = [];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->code = $model->code ?? Str::slug($model->name);
        });
        self::created(function ($model) {});
        self::updated(function ($model) {});
        self::deleted(function ($model) {});
    }
    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public function scopeOfStatus($query, $status)
    {
        return $query->where('countries.status', $status);
    }

    public function provinces()
    {
        return $this->hasMany(Province::class, 'country_id', 'id');
    }
}
