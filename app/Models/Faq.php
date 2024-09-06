<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\OwnModelTrait;
use App\Traits\WnContentModelTraits;
use App\Traits\WnTagTraits;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;


class Faq extends Model
{
    use HasFactory;
    use OwnModelTrait;
    use HasTags;
    use HasTranslations;
    use WnTagTraits;
    use WnContentModelTraits;

    protected $guarded = [];
    
    protected $translatable = ['question','answer','label'];

    public const ICONS = [
        'fontaweseom' => 'fa-solid fa-circle-question'
    ];

    public const ORDERS = [
        'id',
        'status',
        'order',
        'is_pinned',
        'created_at',
        'updated_at',
    ];

    public const ROUTES = [
        'index',
        'create',
    ];

    public const STATUSES = [
        'active',
        'inactive',
    ];


    //! Relationship
    public function website()
    {
        return $this->belongsTo(Website::class);
    }

}
