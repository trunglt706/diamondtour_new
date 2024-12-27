<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
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
        'background',
        'album',
        'description',
        'content',
        'tags',
        'status',
        'like_total',
        'view_total',
        'important',
        'name_en',
        'name_ch',
        'tours',
        'hot',
        'tieu_diem'
    ];

    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->slug = $model->slug ?? Str::slug($model->name);
            $model->status = $model->status ?? self::STATUS_UN_ACTIVE;
            $model->important = $model->important ?? 0;
            $model->name_en = $model->name_en ?? $model->name;
            $model->name_ch = $model->name_ch ?? $model->name;
            $model->hot = $model->hot ?? false;
            $model->tieu_diem = $model->tieu_diem ?? false;
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
            if ($model->background) {
                delete_file($model->background);
            }
            $album = $model->album ? json_decode($model->album) : [];
            foreach ($album as $file) {
                try {
                    delete_file($file);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        });
    }

    const STATUS_UN_ACTIVE = 'draft';
    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_UN_ACTIVE => ['Bản nháp', 'dark'],
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfTieuDiem($query, $tieu_diem)
    {
        return $query->where('posts.tieu_diem', (int)$tieu_diem);
    }

    public function scopeOfHot($query, $hot)
    {
        return $query->where('posts.hot', (int)$hot);
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
                ->orWhere('posts.name', 'LIKE', "%$search%")
                ->orWhereJsonContains('posts.tags', $search);
        });
    }

    public function group()
    {
        return $this->belongsTo(PostGroup::class, 'group_id');
    }
}
