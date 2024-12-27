<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSubmissions extends Model
{
    use HasFactory;
    protected $table = 'event_submissions';
    protected $fillable = [
        'code',
        'name',
        'event_id',
        'position',
        'description',
        'content',
        'link',
        'status'
    ];
    protected $hidden = [];
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = $model->code ?? generateRandomString();
            $model->status = $model->status ?? self::STATUS_ACTIVE;
        });
        self::created(function ($model) {});
        self::updated(function ($model) {});
        self::deleted(function ($model) {
            if ($model->image) {
                delete_file($model->image);
            }
        });
    }

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    public static function get_status($status = '')
    {
        $_status = [
            self::STATUS_ACTIVE => ['Đang kích hoạt', 'success'],
            self::STATUS_BLOCKED => ['Đã khóa', 'danger'],
        ];
        return $status == '' ? $_status : $_status["$status"];
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('event_submissions.status', $status);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('event_submissions.code', $code);
    }

    public function scopeEventId($query, $event_id)
    {
        return $query->where('event_submissions.event_id', $event_id);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('event_submissions.code', 'LIKE', "%$search%")
                ->orWhere('event_submissions.name', 'LIKE', "%$search%")
                ->orWhere('event_submissions.description', 'LIKE', "%$search%");
        });
    }

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
