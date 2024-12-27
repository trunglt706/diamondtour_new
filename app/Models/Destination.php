<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Destination extends Model
{
    use HasFactory;
    protected $table = 'destinations';

    protected $fillable = [
        'group_id',
        'country_id',
        'province_id',
        'slug',
        'code',
        'name',
        'description',
        'image',
        'background',
        'content',
        'address',
        'important',
        'tags',
        'view_total',
        'like_total',
        'price',
        'status',
        'why',
        'plan',
        'tours',
        'type',
        'talk',
        'image_description',
        'image_content',
        'name_en',
        'name_ch',
        'album',
        'tour_group_id',
        'tien_ich',
        'tour_group_ids'
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
            $model->type = $model->type ?? self::TYPE_LOCAL;
            $model->important = $model->important ?? 0;
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
            if ($model->background) {
                delete_file($model->background);
            }
            if ($model->image_description) {
                delete_file($model->image_description);
            }
            if ($model->image_content) {
                delete_file($model->image_content);
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
    const TYPE_NATIONAL = 'national';
    const TYPE_LOCAL = 'local';

    public static function get_type($type = '')
    {
        $_status = [
            self::TYPE_NATIONAL => ['Quốc gia', 'success'],
            self::TYPE_LOCAL => ['Khu vực', 'danger'],
        ];
        return $type == '' ? $_status : $_status["$type"];
    }

    const STATUS_UN_ACTIVE = 'un_active';
    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_UN_ACTIVE => ['Nháp', 'secondary'],
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('destinations.type', $type);
    }

    public function scopeTourGroupIds($query, $groupId)
    {
        return $query->whereJsonContains('group_ids', (string)$groupId);
    }

    public function scopeTourGroupId($query, $tour_group_id)
    {
        return $query->where('destinations.tour_group_id', $tour_group_id);
    }

    public function scopeProvinceId($query, $province_id)
    {
        return $query->where('destinations.province_id', $province_id);
    }

    public function scopeCountryId($query, $country_id)
    {
        return $query->where('destinations.country_id', $country_id);
    }

    public function scopeGroupId($query, $group_id)
    {
        return $query->where('destinations.group_id', $group_id);
    }

    public function scopeOfImportant($query, $important)
    {
        return $query->where('destinations.important', $important);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('destinations.code', $code);
    }

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('destinations.slug', $slug);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('destinations.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('destinations.code', 'LIKE', "%$search%")
                ->orWhere('destinations.name', 'LIKE', "%$search%")
                ->orWhereJsonContains('destinations.tags', $search);
        });
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'destination_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(DestinationGroup::class, 'group_id');
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function tourGroup()
    {
        return $this->belongsTo(TourGroup::class, 'tour_group_id');
    }
}
