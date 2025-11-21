<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Tour extends Model
{
    use HasFactory;
    protected $table = 'tours';

    protected $fillable = [
        'group_id',
        'province_id',
        'slug',
        'code',
        'name',
        'description',
        'price',
        'currency',
        'image',
        'background',
        'duration',
        'content',
        'schedule_file',
        'include',
        'exclude',
        'term',
        'notice',
        'status',
        'important',
        'country_id',
        'images',
        'from',
        'to',
        'name_en',
        'name_ch',
        'tags',
        'season',
        'language',
        'guest',
        'design',
        'bundle',
        'type',
        'location_img',
        'location_description',
        'activity'
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->slug = $model->slug ?? Str::slug($model->name);
            $model->currency = $model->currency ?? 'VND';
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->important = $model->important ?? 0;
            $model->name_en = $model->name_en ?? $model->name;
            $model->name_ch = $model->name_ch ?? $model->name;
            $model->design = $model->design ?? self::IS_NOT_DESIGN;
            $model->bundle = $model->bundle ?? null;
            $model->type = $model->type ?? self::IS_TOUR;
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
            if ($model->location_img) {
                delete_file($model->location_img);
            }
            $images = $model->images ? json_decode($model->images) : [];
            foreach ($images as $item) {
                delete_file($item);
            }
        });
    }

    const IS_DESIGN = '1';
    const IS_NOT_DESIGN = '0';

    const IS_TOUR = '0';
    const IS_LANDTOUR = '1';

    const SEASON_XUAN = 'xuan';
    const SEASON_HA = 'ha';
    const SEASON_THU = 'thu';
    const SEASON_DONG = 'dong';

    const STATUS_UN_ACTIVE = 'draft';
    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_season($season = '')
    {
        $_status = [
            self::SEASON_XUAN => ['Mùa xuân', 'dark'],
            self::SEASON_HA => ['Mùa hạ', 'success'],
            self::SEASON_THU => ['Mùa thu', 'danger'],
            self::SEASON_DONG => ['Mùa đông', 'info'],
        ];
        return $season == '' ? $_status : $_status["$season"];
    }

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_UN_ACTIVE => ['Bản nháp', 'dark'],
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfDesign($query, $design)
    {
        return $query->where('tours.design', (int)$design);
    }

    public function scopeOfBundle($query, $bundle)
    {
        return $query->where('tours.bundle', (int)$bundle);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('tours.type', (int)$type);
    }

    public function scopeOfSeason($query, $season)
    {
        return $query->where('tours.season', $season);
    }

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('tours.slug', $slug);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('tours.code', $code);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('tours.status', $status);
    }

    public function scopeGroupId($query, $group_id)
    {
        return $query->where('tours.group_id', $group_id);
    }

    public function scopeCountryId($query, $country_id)
    {
        return $query->where('tours.country_id', $country_id);
    }

    public function scopeBetween($query, $from, $to)
    {
        return $query->where(function ($q) use ($from, $to) {
            $q->whereBetween('tours.from', [$from, $to])
                ->orWhereBetween('tours.from', [$from, $to])
                ->orWhere(function ($q1) use ($from, $to) {
                    $q1->where('tours.from', '>=', $from)
                        ->where('tours.to', '<=', $to);
                });
        });
    }

    public function scopeFrom($query, $from)
    {
        return $query->where('tours.from', '>=', $from);
    }

    public function scopeTo($query, $to)
    {
        return $query->where('tours.to', '<=', $to);
    }

    public function scopeBetweenPrice($query, $from, $to)
    {
        return $query->where('tours.price', [$from, $to]);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('tours.code', 'LIKE', "%$search%")
                ->orWhere('tours.name', 'LIKE', "%$search%");
        });
    }

    public function group()
    {
        return $this->belongsTo(TourGroup::class, 'group_id')->select('name', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'tour_id', 'id')->orderBy('created_at', 'desc')->select('id', 'name', 'description', 'image', 'tour_id');
    }

    public function withCountry()
    {
        return $this->belongsTo(Countries::class, 'country_id')->select('name', 'id');
    }

    public function groups()
    {
        return $this->hasMany(TourGroupDetail::class, 'tour_id', 'id');
    }
}
