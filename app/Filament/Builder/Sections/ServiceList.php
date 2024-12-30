<?php

namespace App\Filament\Builder\Sections;

use Devlense\FilamentBuilder\SectionBuilder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ServiceList extends SectionBuilder
{
    protected static string $name = 'service_list';

    public static function make($parameters = []): Block
    {
        static::$parameters = $parameters;

        return Block::make(static::$name)
            ->schema([
                Group::make([
                    TextInput::make('subtitle')
                        ->default('Services'),
                    TextInput::make('title')
                        ->default('Explore Our Design Offerings'),
                    Textarea::make('description')
                        ->default('Exploring Excellence in Every Meticulous Design Detail')
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
