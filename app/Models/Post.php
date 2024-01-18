<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = [
        'group_id',
        'slug',
        'code',
        'name',
        'image',
        'album',
        'description',
        'content',
        'tags',
        'status',
        'like_total',
        'view_total',
        'important'
    ];

    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? Str::uuid();
            $model->slug = $model->slug ?? Str::slug('name');
            $model->status = $model->status ?? self::STATUS_UN_ACTIVE;
            $model->important = $model->important ?? false;
        });
        self::created(function ($model) {
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
            // delete image

            // delete album
        });
    }

    const STATUS_UN_ACTIVE = 'un_active';
    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Chưa kích hoạt', 'secondary'],
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã bị khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfImportant($query, $important)
    {
        return $query->where('posts.important', $important);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('posts.code', $code);
    }

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('posts.slug', $slug);
    }

    public function scopeGroupId($query, $group_id)
    {
        return $query->where('posts.group_id', $group_id);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('posts.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('posts.code', 'LIKE', "%$search%")
                ->orWhere('posts.name', 'LIKE', "%$search%");
        });
    }

    public function group()
    {
        return $this->belongsTo(PostGroup::class, 'group_id');
    }
}
