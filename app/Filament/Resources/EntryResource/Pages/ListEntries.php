<?php

namespace App\Filament\Resources\EntryResource\Pages;

use App\Filament\Resources\EntryResource;
use App\Models\Collection;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListEntries extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = EntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $postTypes = Collection::all()->pluck('title', 'id');

        $postTypesTabs = $postTypes->mapWithKeys(function ($title, $id) {
            return [
                $id => Tab::make($title)->query(fn ($query) => $query->where('post_type_id', $id)),
            ];
        });

        return [
            null => Tab::make('All'),
        ] + $postTypesTabs->toArray();

    }
}
