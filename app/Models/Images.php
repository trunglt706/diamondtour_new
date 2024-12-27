<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Images extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = [
        'table',
        'table_id',
        'code',
        'url',
        'numering'
    ];
    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->numering = $model->numering ?? self::getOrder($model);
        });
        self::created(function ($model) {
            Cache::flush();
        });
        self::updated(function ($model) {
            Cache::flush();
        });
        self::deleted(function ($model) {
            Cache::flush();
            if ($model->url) {
                delete_file($model->url);
            }
        });
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('images.code', $code);
    }

    public function scopeOfTable($query, $table)
    {
        return $query->where('images.table', $table);
    }

    public function scopeTableId($query, $table_id)
    {
        return $query->where('images.table_id', $table_id);
    }

    public static function getOrder($model)
    {
        if ($model->code) {
            $max = Images::ofCode($model->code)->max('numering') ?? 0;
        } else {
            $max = Images::ofTable($model->table)->tableId($model->table_id)->max('numering') ?? 0;
        }
        return $max + 1;
    }
}
