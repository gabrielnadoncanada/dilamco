<?php

namespace App\Filament\Resources;

use App\Enums\PermalinkType;
use App\Filament\AbstractResource;
use App\Filament\Fields\TitleWithSlugInput;
use App\Filament\Resources\CollectionResource\Pages;
use App\Filament\Resources\CollectionResource\Pages\CreateCollection;
use App\Filament\Resources\CollectionResource\Pages\EditCollection;
use App\Models\Collection;
use App\Models\Entry;
use App\Models\Single;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;

class CollectionResource extends AbstractResource
{
    protected static ?string $model = Collection::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

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
            TitleWithSlugInput::make(
                fieldTitle: Collection::TITLE,
                fieldSlug: Collection::SLUG,
            ),
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
                TextColumn::make(Collection::TITLE),
                TextColumn::make('entries_count')
                    ->counts('entries'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRecordSubNavigation(Page $page): array
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

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.group.administration');
    }
}
