<?php

namespace App\Filament\Resources;

use App\Filament\AbstractResource;
use App\Filament\Fields\IsVisible;
use App\Filament\Fields\Meta;
use App\Filament\Fields\TitleWithSlugInput;
use App\Filament\Resources\EntryResource\Pages;
use App\Models\Collection;
use App\Models\Entry;
use App\Models\Shop;
use App\Models\Single;
use App\Tables\Columns\TextImage;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Pboivin\FilamentPeek\Tables\Actions\ListPreviewAction;

class EntryResource extends AbstractResource
{
    protected static ?string $model = Entry::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static function leftColumn(): array
    {
        return [
            Section::make()
                ->schema([
                    TitleWithSlugInput::make(
                        fieldTitle: Entry::TITLE,
                        fieldSlug: Entry::SLUG,
                    ),
                    Textarea::make(Entry::DESCRIPTION)
                        ->rows(3),
                    SpatieMediaLibraryFileUpload::make(Entry::IMAGE)
                        ->collection(Entry::MEDIA_COLLECTION)
                        ->image(),
                ]),
            Section::make('SEO')
                ->collapsed()
                ->collapsible()
                ->schema([
                    Meta::make(),
                ]),

        ];
    }

    protected static function rightColumn(): array
    {
        return [
            Section::make()
                ->schema([
                    //                    Select::make('collection_id')
                    //                        ->required()
                    //                        ->relationship('collection', Collection::TITLE)
                    //                        ->searchable()
                    //                        ->preload(),
                    DatePicker::make(Entry::PUBLISHED_AT)
                        ->default(now())
                        ->required(),
                    Toggle::make(Entry::IS_VISIBLE)
                        ->default(true),

                    //                                    Select::make('categories')
                    //                                        ->multiple()
                    //                                        ->relationship('categories', Post::TITLE)
                    //                                        ->searchable()
                    //                                        ->preload()
                    //                                        ->editOptionForm(function ($record) {
                    //                                            return $record->createOptionForm(CategoryResource::getGeneralSchema());
                    //                                        })
                    //                                        ->createOptionForm(CategoryResource::getGeneralSchema()),
                ]),

        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make(Entry::IMAGE)
                    ->collection(Entry::MEDIA_COLLECTION),
                TextColumn::make(Entry::TITLE)
                    ->tooltip(fn ($record): string => $record->{Entry::DESCRIPTION} ?? ''),
                IsVisible::make(Entry::IS_VISIBLE),
            ])
            ->filters([])
            ->actions([
                ActionGroup::make([
                    ListPreviewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->headerActions([
               CreateAction::make(),
            ])
            ->groupedBulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEntries::route('/'),
            'create' => Pages\CreateEntry::route('/create'),
            'edit' => Pages\EditEntry::route('/{record}/edit'),
        ];
    }
}
