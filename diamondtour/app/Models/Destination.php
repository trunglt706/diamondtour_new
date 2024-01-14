<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Destination extends Model
{
    use HasFactory;
    protected $table = 'destinations';

    protected $fillable = [
        'slug',
        'code',
        'name',
        'description',
        'background',
        'price',
        'why_select',
        'status'
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
        });
        self::created(function ($model) {
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
            // delete background
        });
    }

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'unactive';

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

    public function reviews()
    {
        return $this->hasMany(Review::class, 'destination_id', 'id');
    }
}
