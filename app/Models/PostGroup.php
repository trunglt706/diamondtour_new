<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PostGroup extends Model
{
    use HasFactory;
    protected $table = 'post_groups';

    protected $fillable = [
        'slug',
        'code',
        'name',
        'image',
        'status',
        'numering',
        'name_en',
        'name_ch',
        'view_total',
        'like_total',
    ];

    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->slug = $model->slug ?? Str::slug($model->name);
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->numering = $model->numering ?? 0;
            $model->name_en = $model->name_en ?? $model->name;
            $model->name_ch = $model->name_ch ?? $model->name;
        });
        self::created(function ($model) {
            Cache::flush();
        });
        self::updated(function ($model) {
            Cache::flush();
        });
        self::deleted(function ($model) {
            Cache::flush();
            if ($model->image) {
                delete_file($model->image);
            }
        });
    }

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã bị khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('post_groups.slug', $slug);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('post_groups.code', $code);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('post_groups.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('post_groups.code', 'LIKE', "%$search%")
                ->orWhere('post_groups.name', 'LIKE', "%$search%");
        });
    }

    public function blogs()
    {
        return $this->hasMany(Post::class, 'group_id', 'id');
    }

    public static function getOrder()
    {
        $max = PostGroup::max('numering') ?? 0;
        return $max + 1;
    }
}
