<?php

namespace App\Models;

use App\Filament\Builder\Templates\Post as TemplatePost;
use App\Traits\HasMeta;
use Devlense\FilamentBuilder\Concerns\HasContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Entry extends Model implements HasMedia
{
    use HasContent;
    use HasFactory;
    use HasMeta;
    use HasSlug;
    use InteractsWithMedia;

    public const ID = 'id';

    public const TITLE = 'title';

    public const SLUG = 'slug';
    public const IMAGE = 'image';

    public const DESCRIPTION = 'description';

    public const COLLECTION_ID = 'description';

    public const PUBLISHED_AT = 'published_at';

    public const IS_VISIBLE = 'is_visible';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    public const MEDIA_COLLECTION = 'entries';


    protected $guarded = [];

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorize');
    }

    public function template(): string
    {
        return TemplatePost::class;
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(self::TITLE)
            ->doNotGenerateSlugsOnUpdate()
            ->saveSlugsTo(self::SLUG);
    }
}
