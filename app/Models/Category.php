<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $guarded = [];

    public const ID = 'id';

    public const TITLE = 'title';

    public const SLUG = 'slug';

    public const DESCRIPTION = 'description';

    public const IS_VISIBLE = 'is_visible';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    public const MEDIA_COLLECTION = 'categories';

    public function items(): MorphToMany
    {
        return $this->morphedByMany(Entry::class, 'categorize');
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
