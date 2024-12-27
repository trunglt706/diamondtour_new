<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';

    protected $fillable = [
        'group_id',
        'code',
        'name',
        'value',
        'type',
        'description',
        'data',
        'numering',
        'status',
        'value_en',
        'value_ch'
    ];

    protected $hidden = [];

    protected $casts = [
        'group_id' => 'integer',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->numering = $model->numering ?? self::getOrder($model->group_id);
            $model->value_en = $model->value_en ?? $model->value;
            $model->value_ch = $model->value_ch ?? $model->value;
        });
        self::created(function ($model) {
            Cache::flush();
        });
        self::updated(function ($model) {
            Cache::flush();
        });
        self::deleted(function ($model) {
            Cache::flush();
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

    const TYPE_TEXT = 'text';
    const TYPE_FILE = 'file';
    const TYPE_CHECK_BOX = 'checkbox';
    const TYPE_COLOR = 'color';
    const TYPE_TEXT_AREA = 'textarea';
    const TYPE_RADIO = 'radio';
    const TYPE_EDITOR = 'editor';
    const TYPE_IMAGES = 'images';

    public static function get_type($type = '')
    {
        $types = [
            self::TYPE_TEXT => 'Text input',
            self::TYPE_FILE => 'File',
            self::TYPE_CHECK_BOX => 'Check box',
            self::TYPE_COLOR => 'Color',
            self::TYPE_TEXT_AREA => 'Text area',
            self::TYPE_RADIO => 'Radio button',
            self::TYPE_EDITOR => 'Editor',
            self::TYPE_IMAGES => 'Images',
        ];
        return $type == '' ? $types : $types["$type"];
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('settings.status', $status);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('settings.code', $code);
    }

    public function scopeGroupId($query, $group_id)
    {
        return $query->where('settings.group_id', $group_id);
    }

    public function scopeOfType($query, $type)
    {
        if (is_array($type)) {
            return $query->whereIn('settings.type', $type);
        }
        return $query->where('settings.type', $type);
    }

    public function group()
    {
        return $this->belongsTo(SettingGroup::class, 'group_id');
    }

    public static function getOrder($group_id)
    {
        $max = Setting::groupId($group_id)->max('numering') ?? 0;
        return $max + 1;
    }
}
