<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'email',
        'password',
        'last_login',
        'status',
        'admin',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->status = $model->status ?? self::STATUS_UN_ACTIVE;
        });
        self::created(function ($model) {
        });
        self::updated(function ($model) {
        });
        self::deleted(function ($model) {
        });
    }

    const MAX_TIME_ACTIVE_CODE = 3; // minutes

    const IS_ADMIN = 1;
    const NOT_ADMIN = 2;

    const STATUS_UN_ACTIVE = 'un_active';
    const STATUS_ACTIVE = 'active';
    const STATUS_SUSPEND = 'blocked';

    public static function get_status($status = '')
    {
        $types = [
            self::STATUS_UN_ACTIVE => ['Chưa kích hoạt', 'dark', COLOR_DARK],
            self::STATUS_ACTIVE => ['Đang hoạt động', 'success', COLOR_SUCCESS],
            self::STATUS_SUSPEND => ['Tạm ngưng', 'danger', COLOR_DANGER],
        ];
        return $status == '' ? $types : $types["$status"];
    }

    public function scopeActiveCode($query, $active_code)
    {
        return $query->where('users.active_code', $active_code);
    }

    public function scopeActiveCodeExpired($query)
    {
        return $query->whereNotNull('users.active_expire')->where('users.active_expire', '>', time());
    }

    public function scopeOfEmail($query, $email)
    {
        return $query->where('users.email', $email);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('users.status', $status);
    }

    public function scopeActive($query)
    {
        return $query->where('users.status', self::STATUS_ACTIVE);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('users.name', 'LIKE', "%$search%")
                ->orWhere('users.email', 'LIKE', "%$search%")
                ->orWhere('users.code', 'LIKE', "%$search%");
        });
    }
}
