<?php

namespace App\Filament;

use Filament\Forms\Components\Group;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

abstract class AbstractResource extends Resource
{
    protected static string $customRecordTitleAttribute = '';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema(static::leftColumn())
                    ->columnSpan(['lg' => fn ($record) => static::leftColumnSpan($record)]),
                Group::make()
                    ->schema(static::rightColumn())
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function leftColumnSpan(?Model $record): int
    {
        return (static::hasRightColumn()) ? 2 : 3;
    }

    private static function hasRightColumn(): bool
    {
        return ! empty(static::rightColumn());
    }

    abstract protected static function leftColumn(): array;

    protected static function rightColumn(): array
    {
        return [

        ];
    }
    //
    //    public static function getModelLabel(): string
    //    {
    //        $parentLabel = parent::getModelLabel();
    //        $translationKey = 'filament.models.'.$parentLabel;
    //
    //        if (Lang::has($translationKey)) {
    //            return __($translationKey);
    //        } else {
    //            return $parentLabel;
    //        }
    //    }

    public static function getRecordTitle(?Model $record): string|Htmlable|null
    {
        if (! static::$customRecordTitleAttribute) {
            return parent::getRecordTitle($record);
        }

        $customRecordTitleAttribute = strtoupper(static::$customRecordTitleAttribute);

        return sprintf(
            '%s (%s)',
            $record?->getAttribute(
                get_class($record)::{$customRecordTitleAttribute}
            ), static::getModelLabel()
        );
    }
}
