<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Collection extends Model
{
    use HasFactory;

    public const ID = 'id';

    public const TITLE = 'title';

    public const HAS_ARCHIVE = 'has_archive';

    public const SINGLE_ID = 'single_id';

    public const PERMALINK_TYPE = 'permalink_type';

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            $collection->{self::SLUG} = Str::slug($collection->{self::TITLE});
        });
    }

    public function single(): BelongsTo
    {
        return $this->belongsTo(Single::class);
    }
}
