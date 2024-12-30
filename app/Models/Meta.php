<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Meta extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const ID = 'id';

    public const METAABLE_ID = 'metaable_id';

    public const METAABLE_TYPE = 'metaable_type';

    public const TITLE = 'title';

    public const DESCRIPTION = 'description';

    public const INDEXABLE = 'indexable';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    public const MEDIA_COLLECTION = 'metas';

    protected $guarded = [

    ];

    protected $casts = [
        'id' => 'integer',
        'indexable' => 'boolean',
    ];

    public function metaable(): MorphTo
    {
        return $this->morphTo();
    }
}
