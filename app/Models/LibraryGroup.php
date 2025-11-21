<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LibraryGroup extends Model
{
    use HasFactory;
    protected $table = 'library_groups';

    protected $fillable = [
        'slug',
        'name',
        'description',
        'image',
        'background',
        'status',
        'important',
        'numering',
        'name_en',
        'name_ch',
        'like_total',
        'view_total',
        'guest',
        'hot',
        'date',
        'address',
        'tour_group_id',
        'season',
    ];

    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->slug = $model->slug ?? Str::slug($model->name);
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->important = $model->important ?? false;
            $model->numering = $model->numering ?? 0;
            $model->name_en = $model->name_en ?? $model->name;
            $model->name_ch = $model->name_ch ?? $model->name;
            $model->guest = $model->guest ?? false;
            $model->hot = $model->hot ?? false;
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
        });
    }

    const SEASON_XUAN = 'xuan';
    const SEASON_HA = 'ha';
    const SEASON_THU = 'thu';
    const SEASON_DONG = 'dong';

    const IMPORTANT = 1;
    const NONE_IMPORTANT = 0;

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    const GUEST = 1;
    const NONE_GUEST = 0;

    const HOT = 1;
    const NONE_HOT = 0;

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

    public static function get_important($status = '')
    {
        $_status = [
            self::IMPORTANT => ['Ưu tiên', 'success'],
            self::NONE_IMPORTANT => ['Không ưu tiên', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã bị khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfSeason($query, $season)
    {
        return $query->where('library_groups.season', $season);
    }

    public function scopeTourGroupId($query, $tour_group_id)
    {
        return $query->where('library_groups.tour_group_id', $tour_group_id);
    }

    public function scopeOfDate($query, $date)
    {
        return $query->where('library_groups.date', $date);
    }

    public function scopeOfHot($query, $hot)
    {
        return $query->where('library_groups.hot', (int)$hot);
    }

    public function scopeOfGuest($query, $guest)
    {
        return $query->where('library_groups.guest', (int)$guest);
    }

    public function scopeOfImportant($query, $important)
    {
        return $query->where('library_groups.important', (int)$important);
    }

    public function scopeOfSlug($query, $slug)
    {
        return $query->where('library_groups.slug', $slug);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('library_groups.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('library_groups.name', 'LIKE', "%$search%");
        });
    }

    public function libraries()
    {
        return $this->hasMany(Library::class, 'group_id', 'id');
    }

    public static function getOrder()
    {
        $max = LibraryGroup::max('numering') ?? 0;
        return $max + 1;
    }

    public function tourGroup()
    {
        return $this->belongsTo(TourGroup::class, 'tour_group_id');
    }
}
