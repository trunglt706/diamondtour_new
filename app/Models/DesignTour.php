<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vanthao03596\HCVN\Models\Province;

class DesignTour extends Model
{
    use HasFactory;
    protected $table = 'design_tours';

    protected $fillable = [
        'code',
        'country_id',
        'tour_group_id',
        'someone_id',
        'service_id',
        'age_id',
        'place_id',
        'balance_id',
        'style_id',
        'someone_other',
        'adults',
        'children',
        'place_start_other',
        'time_tour',
        'expected_date',
        'choose_date_number',
        'expected_date_number',
        'tour_guide',
        'message',
        'special',
        'name',
        'email',
        'phone',
        'agree_terms',
        'status'
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->adults = $model->adults ?? 1;
            $model->children = $model->children ?? 0;
            $model->status = $model->status ?? self::STATUS_UN_ACTIVE;
            $model->agree_terms = $model->agree_terms ?? 0;
        });
        self::created(function ($model) {
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
        });
    }
    const STATUS_UN_ACTIVE = 'un_active';
    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_UN_ACTIVE => ['Chưa kích hoạt', 'secondary'],
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã bị khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeCountryId($query, $country_id)
    {
        return $query->where('design_tours.country_id', $country_id);
    }

    public function scopeTourGroupId($query, $tour_group_id)
    {
        return $query->where('design_tours.tour_group_id', $tour_group_id);
    }

    public function scopeSomeoneId($query, $someone_id)
    {
        return $query->where('design_tours.someone_id', $someone_id);
    }

    public function scopeAgeId($query, $age_id)
    {
        return $query->where('design_tours.age_id', $age_id);
    }

    public function scopePlaceId($query, $place_id)
    {
        return $query->where('design_tours.place_id', $place_id);
    }

    public function scopeBalanceId($query, $balance_id)
    {
        return $query->where('design_tours.balance_id', $balance_id);
    }

    public function scopeStyleId($query, $style_id)
    {
        return $query->where('design_tours.style_id', $style_id);
    }

    public function scopeServiceId($query, $service_id)
    {
        return $query->where('design_tours.service_id', $service_id);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('design_tours.code', $code);
    }

    public function scopeOfPhone($query, $phone)
    {
        return $query->where('design_tours.phone', $phone);
    }

    public function scopeOfEmail($query, $email)
    {
        return $query->where('design_tours.email', $email);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('design_tours.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('design_tours.code', 'LIKE', "%$search%")
                ->orWhere('design_tours.name', 'LIKE', "%$search%")
                ->orWhere('design_tours.phone', 'LIKE', "%$search%");
        });
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }

    public function tourGroup()
    {
        return $this->belongsTo(TourGroup::class, 'tour_group_id');
    }

    public function object()
    {
        return $this->belongsTo(TourObject::class, 'someone_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'place_id');
    }

    public function balance()
    {
        return $this->belongsTo(TourBalance::class, 'balance_id');
    }

    public function style()
    {
        return $this->belongsTo(TourStyle::class, 'style_id');
    }

    public function service()
    {
        return $this->belongsTo(TourService::class, 'service_id');
    }
}
