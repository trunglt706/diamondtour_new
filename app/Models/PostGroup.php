<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'numering'
    ];

    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? Str::uuid();
            $model->slug = $model->code ?? Str::slug('name');
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->numering = $model->numering ?? self::getOrder();
        });
        self::created(function ($model) {
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
            // delete image
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

    public function posts()
    {
        return $this->hasMany(Post::class, 'group_id', 'id');
    }

    public static function getOrder()
    {
        $max = PostGroup::max('numering') ?? 0;
        return $max + 1;
    }
}
