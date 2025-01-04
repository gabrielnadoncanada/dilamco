<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Collection extends Model
{
    use HasFactory, HasSlug;

    public const ID = 'id';

    public const TITLE = 'title';

    public const HAS_ARCHIVE = 'has_archive';

    public const SINGLE_ID = 'single_id';

    public const SHOW_IN_ADMIN_MENU = 'show_in_admin_menu';

    public const ADMIN_MENU_ICON = 'admin_menu_icon';

    public const SLUG = 'slug';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    protected $guarded = [];

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
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
