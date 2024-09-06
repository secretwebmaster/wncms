<?php

namespace App\Models;

use App\Traits\WnTagTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use DateTimeInterface;

class UpdateLog extends Model
{
    use HasFactory;
    use HasTags;
    use WnTagTraits;

    protected $guarded = [];

    protected $casts = [
        'released_at' => 'datetime',
        'content' => 'array',
    ];

    public $menuPriority = 1000;

    public const ICONS = [
        'fontaweseom' => 'fa-solid fa-cube text-warning'
    ];

    public const ROUTES = [
        'index',
        'create',
    ];



    public const TYPES = [
        'core',
        'theme',
        'plugin',
    ];

    public function scopeOrderByVersion($query)
    {
        return $query->orderByRaw("CAST(SUBSTRING_INDEX(version, '.', 1) AS UNSIGNED) DESC")
            ->orderByRaw("CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(version, '.', -2), '.', 1) AS UNSIGNED) DESC")
            ->orderByRaw("CAST(SUBSTRING_INDEX(version, '.', -1) AS UNSIGNED) DESC");
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
