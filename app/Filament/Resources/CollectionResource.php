<?php

namespace App\Filament\Resources;

use App\Enums\PermalinkType;
use App\Filament\AbstractResource;
use App\Filament\Resources\CollectionResource\Pages;
use App\Filament\Resources\CollectionResource\Pages\CreateCollection;
use App\Filament\Resources\CollectionResource\Pages\EditCollection;
use App\Models\Collection;
use App\Models\Single;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;

class CollectionResource extends AbstractResource
{
    protected static ?string $model = Collection::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static function leftColumn(): array
    {
        return [
            Section::make(self::getDetailsSchema()),
        ];
    }

    public static function getDetailsSchema(): array
    {
        return [
            TextInput::make(Collection::TITLE)
                ->required(),
            Select::make(Collection::PERMALINK_TYPE)
                ->options(PermalinkType::class)
                ->default(PermalinkType::KEY),
            Toggle::make(Collection::SHOW_IN_ADMIN_MENU)
                ->default(true),
            IconPicker::make(Collection::ADMIN_MENU_ICON)
                ->required()
                ->preload(),
            Toggle::make(Collection::HAS_ARCHIVE)
                ->live()
                ->default(true),
            Select::make(Collection::SINGLE_ID)
                ->hidden(fn ($get) => ! $get(Collection::HAS_ARCHIVE))
                ->relationship('single', Single::TITLE),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(Collection::TITLE),
                Tables\Columns\TextColumn::make('entries_count')->counts('entries'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRecordSubNavigation(\Filament\Resources\Pages\Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditCollection::class,
            Pages\ManageEntries::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCollections::route('/'),
            'edit' => EditCollection::route('/{record}/edit'),
            'create' => CreateCollection::route('/create'),
            'items' => Pages\ManageEntries::route('/{record}/entries'),
        ];
    }
}
