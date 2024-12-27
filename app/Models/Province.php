<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    protected $fillable = [
        'code',
        'name',
        'slug',
        'type',
        'country_id'
    ];

    protected $hidden = [];
    protected $casts = [];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->slug = $model->slug ?? Str::slug($model->name);
            $model->type = $model->type ?? 'tinh';
            $model->name_with_type = $model->name;
        });
        self::created(function ($model) {
            Cache::flush();
        });
        self::updated(function ($model) {
            Cache::flush();
        });
        self::deleted(function ($model) {
            Cache::flush();
        });
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('provinces.code', $code);
    }

    public function scopeCountryId($query, $country_id)
    {
        return $query->where('provinces.country_id', $country_id);
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }
}
