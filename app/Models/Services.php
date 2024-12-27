<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'name',
        'image',
        'status',
        'description',
        // 'backgrounds',
        'link',
        'name_en',
        'name_ch',
        'description_en',
        'description_ch',
        'numering',
    ];

    protected $hidden = [];

    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->name_en = $model->name_en ?? $model->name;
            $model->name_ch = $model->name_ch ?? $model->name;
            $model->description_en = $model->description_en ?? $model->description;
            $model->description_ch = $model->description_ch ?? $model->description;
            $model->numering = $model->numering ?? self::getOrder();
        });
        self::created(function ($model) {});
        self::updated(function ($model) {});
        self::deleted(function ($model) {
            if ($model->image) {
                delete_file($model->image);
            }
            if ($model->backgrounds) {
                $backgrounds = json_decode($model->backgrounds);
                foreach ($backgrounds as $bg) {
                    delete_file($bg);
                }
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

    public function scopeOfStatus($query, $status)
    {
        return $query->where('services.status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('services.description', 'LIKE', "%$search%")
                ->orWhere('services.name', 'LIKE', "%$search%");
        });
    }

    public static function  getOrder()
    {
        $max = Services::max('numering') ?? 0;
        return $max + 1;
    }
}
