<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wncms\Translatable\Traits\HasTranslations;

class ContactFormOption extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = [];

    public const ICONS = [
        'fontaweseom' => 'fa-solid fa-square-envelope'
    ];

    public const ROUTES = [
        // 'index',
        // 'create',
    ];

    public const TYPES = [
        'text',
        'textarea',
        'number',
        'select',
        'radio',
        'checkbox',
        'hidden',
        'utm_trackers',

        'country',
        'city',
        'language',
    ];

    protected $translatable = ['display_name','placeholder','default_value','options'];

    public function contact_form()
    {
        return $this->belongsToMany(ContactForm::class, 'contact_form_option_relationship', 'option_id', 'form_id');
    }

}
