<?php

namespace App\Filament\Resources\CollectionResource\Pages;

use App\Filament\Resources\CollectionResource;
use App\Filament\Resources\EntryResource;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;

class ManageEntries extends ManageRelatedRecords
{
    protected static string $resource = CollectionResource::class;

    protected static string $relationship = 'entries';

    public function form(Form $form): Form
    {
        return EntryResource::form($form);
    }

    public function table(Table $table): Table
    {
        return EntryResource::table($table);
    }
}
