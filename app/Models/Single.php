<?php

namespace App\Models;

use App\Enums\PublishedStatus;
use App\Filament\Builder\Templates\Blog;
use App\Filament\Builder\Templates\Contact;
use App\Filament\Builder\Templates\Home;
use App\Filament\Builder\Templates\Products;
use App\Filament\Builder\Templates\Services;
use App\Filament\Builder\Templates\Team;
use App\Settings\ThemeSettings;
use App\Traits\HasMeta;
use Devlense\FilamentBuilder\Concerns\HasContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Single extends Model implements HasMedia
{
    use HasContent;
    use HasFactory;
    use HasMeta;
    use HasSlug;
    use InteractsWithMedia;

    public const ID = 'id';

    public const TITLE = 'title';
    public const IMAGE = 'image';

    public const SLUG = 'slug';

    public const DESCRIPTION = 'description';

    public const IS_VISIBLE = 'is_visible';

    public const PUBLISHED_AT = 'published_at';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    public const MEDIA_COLLECTION = 'singles';

    protected $guarded = [];

    protected $casts = [
        'status' => PublishedStatus::class,
    ];

    public function getBasePath(): string
    {
        return '/';
    }

    public function getPublicUrl(): string
    {
        return url()->to($this->getBasePath().$this->slug.'/');
    }

    public function isHomePage(): bool
    {
        return app(ThemeSettings::class)->home_page_id == $this->id;
    }

    public function isServicesPage(): bool
    {
        return theme('service_page_id') == $this->id;
    }

    public function template(): string
    {
        if ($this->slug == 'contact') {
            return Contact::class;
        }

        if ($this->slug == 'blogue') {
            return Blog::class;
        }

        if ($this->slug == 'equipes') {
            return Team::class;
        }

        if ($this->slug == 'products') {
            return Products::class;
        }

        if ($this->isHomePage()) {
            return Home::class;
        }

        if ($this->isServicesPage()) {
            return Services::class;
        }

        return Single::class;
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(self::TITLE)
            ->doNotGenerateSlugsOnUpdate()
            ->saveSlugsTo(self::SLUG);
    }

    public function getRouteKeyName(): string
    {
        return self::SLUG;
    }
}
