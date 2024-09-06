<?php

namespace App\Models;

use App\Traits\CustomWebsiteTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Website extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use CustomWebsiteTraits;

    protected $guarded = [];

    protected $withs = ['media'];

    public const ICONS = [
        'fontaweseom' => 'fa-solid fa-globe'
    ];

    public const ROUTES = [
        'index',
        'create',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('site_logo')->singleFile();
        $this->addMediaCollection('site_logo_white')->singleFile();
        $this->addMediaCollection('site_favicon')->singleFile();
    }


    //! Relationships
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    public function domain_aliases()
    {
        return $this->hasMany(DomainAlias::class);
    }
    
    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
    
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function search_keywords()
    {
        return $this->hasMany(SearchKeyword::class);
    }

    public function theme_options()
    {
        return $this->hasMany(ThemeOption::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function contact_form_submissions()
    {
        return $this->hasMany(ContactFormSubmission::class);
    }


    //! Attribute
    public function getSiteFaviconAttribute()
    {
        return $this->getFirstMediaUrl('site_favicon');
    }

    public function getSiteLogoAttribute()
    {
        return $this->getFirstMediaUrl('site_logo');
    }

    public function getSiteLogoWhiteAttribute()
    {
        return $this->getFirstMediaUrl('site_logo_white');
    }

    public function getUrlAttribute()
    {
        return wncms_add_https($this->domain);
    }


    //! Functions
    public function get_options()
    {
        return $this->theme_options()->where('theme',$this->theme ?? 'default')->pluck('value','key')->toArray();
    }

    public function get_option($key)
    {
        return data_get($this->get_options(), $key);
    }


}
