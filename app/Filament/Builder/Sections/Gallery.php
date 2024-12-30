<?php

namespace App\Filament\Builder\Sections;

use Devlense\FilamentBuilder\SectionBuilder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class Gallery extends SectionBuilder
{
    protected static string $name = 'gallery';

    public static function make($parameters = []): Block
    {
        static::$parameters = $parameters;

        return Block::make(static::$name)
            ->schema([
                Group::make([
                    TextInput::make('subtitle')
                        ->default('Gallery'),
                    TextInput::make('title')
                        ->default('Exploring Our Creations'),
                    Textarea::make('description')
                        ->default('Where Imagination Takes Flight, and Excellence Blossoms')
                        ->columnSpanFull(),
                ])->columns(),
            ]);
    }

    public static function blocks($parameters): array
    {
        return [
        ];
    }

    public static function defaultParameters(): array
    {
        return [

        ];
    }

    public static function settings($parameters): array
    {
        return [

        ];
    }

    public static function preset(): array
    {
        return [

        ];
    }

    protected static function maxItems(): int {}
}
