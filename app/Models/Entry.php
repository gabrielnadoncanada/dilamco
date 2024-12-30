<?php

namespace App\Models;

use App\Filament\Builder\Templates\Post as TemplatePost;
use App\Traits\HasMeta;
use Devlense\FilamentBuilder\Concerns\HasContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasContent;
    use HasFactory;
    use HasMeta;

    public const ID = 'id';

    public const TITLE = 'title';

    public const SLUG = 'slug';

    public const DESCRIPTION = 'description';

    public const COLLECTION_ID = 'description';

    public const PUBLISHED_AT = 'published_at';

    public const IS_VISIBLE = 'is_visible';

    public const IMAGE = 'image';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    protected $guarded = [];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorize');
    }

    public function scopePublished($query)
    {
        return $query->where('is_visible', '!=', false)
            ->where('published_at', '<=', now());
    }

    public function getPublicUrl()
    {
        return $this->postType->{Collection::SLUG}.'/'.$this->{Entry::SLUG};
    }

    public function template(): string
    {
        return TemplatePost::class;
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
