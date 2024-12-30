<?php

namespace App\Filament\Resources\SingleResource\Pages;

use App\Filament\Resources\SingleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSingles extends ListRecords
{
    protected static string $resource = SingleResource::class;

    protected function getTableQuery(): ?Builder
    {

        return static::getResource()::getEloquentQuery();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
