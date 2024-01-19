<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAction extends Model
{
    use HasFactory;
    protected $table = 'log_actions';

    protected $fillable = [
        'user_id',
        'data_json',
        'description',
        'ip',
        'device',
        'link',
        'created_at'
    ];

    protected $hidden = [];

    protected $casts = [
        'user_id' => 'integer',
        'data_json' => 'json',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopeUserId($query, $user_id)
    {
        if (is_array($user_id)) {
            return $query->whereIn('log_actions.user_id', $user_id);
        }
        return $query->where('log_actions.user_id', $user_id);
    }

    public function scopeOfIp($query, $ip)
    {
        return $query->where('log_actions.ip', $ip);
    }

    public function scopeOfMe($query)
    {
        return $query->where('log_actions.user_id', auth()->user()->id);
    }

    public function scopeDate($query, $date)
    {
        $_date = Carbon::parse($date)->format('Y-m-d');
        return $query->whereDate('log_actions.created_at', $_date);
    }

    public function scopeOfDate($query, $from, $to)
    {
        $_from = Carbon::parse($from)->startOfDay();
        $_to = Carbon::parse($to)->endOfDay();
        return $query->whereBetween('log_actions.created_at', [$_from, $_to]);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('log_actions.description', 'LIKE', "%$search%");
        });
    }
}
