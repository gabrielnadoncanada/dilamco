<?php

namespace App\Filament\Builder\Templates;

use Devlense\FilamentBuilder\TemplateBuilder;
use Filament\Forms\Components\Builder;

class Post extends TemplateBuilder
{
    protected static ?string $name = 'post';

    public static function schema(): array
    {
        return [
            Post::createTemplateSection('Content',
                sections: [
                ],
                modifyBuilder: function (Builder $builder) {
                    $builder->collapsible()->collapsed();
                }),
        ];
    }
}
