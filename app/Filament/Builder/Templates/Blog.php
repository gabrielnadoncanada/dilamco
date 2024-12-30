<?php

namespace App\Filament\Builder\Templates;

use App\Filament\Builder\Sections\BlogList;
use Devlense\FilamentBuilder\TemplateBuilder;
use Filament\Forms\Components\Builder;

class Blog extends TemplateBuilder
{
    protected static ?string $name = 'contact';

    public static function schema(): array
    {
        return [
            Post::createTemplateSection('Content',
                sections: [
                    BlogList::make(),
                ],
                modifyBuilder: function (Builder $builder) {
                    $builder->collapsible()->collapsed();
                }),
        ];
    }
}
