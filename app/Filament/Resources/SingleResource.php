<?php

namespace App\Filament\Resources;

use App\Filament\Fields\IsVisible;
use App\Filament\Fields\Meta;
use App\Filament\Fields\TimeStampSection;
use App\Filament\Fields\TitleWithSlugInput;
use App\Filament\Resources\SingleResource\Pages;
use App\Models\Single;
use Devlense\FilamentBuilder\Components\Content;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Pboivin\FilamentPeek\Tables\Actions\ListPreviewAction;

class SingleResource extends Resource
{
    protected static ?string $model = Single::class;

    protected static ?string $navigationGroup = 'Site';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = true;

    protected static ?string $recordTitleAttribute = Single::TITLE;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Group::make()
                            ->schema([
                                Tabs::make('Tabs')
                                    ->tabs([
                                        Tabs\Tab::make('General')
                                            ->schema([
                                                TitleWithSlugInput::make(
                                                    fieldTitle: Single::TITLE,
                                                    fieldSlug: Single::SLUG,
                                                ),
                                                Textarea::make(Single::DESCRIPTION)
                                                    ->rows(3),
                                                FileUpload::make(Single::IMAGE)
                                                    ->image(),
                                            ]),
                                        Tabs\Tab::make('SEO')
                                            ->schema([
                                                Meta::make(),
                                            ]),
                                    ]),
                            ])
                            ->columnSpan(['lg' => 2]),
                        Group::make()
                            ->schema([
                                TimeStampSection::make(),
                                Section::make('Status')
                                    ->schema([
                                        Toggle::make(Single::IS_VISIBLE)
                                            ->default(true),
                                        DatePicker::make(Single::PUBLISHED_AT)
                                            ->default(now())
                                            ->required(),
                                    ]),
                            ])
                            ->columnSpan(['lg' => 1]),
                    ])->columns(3),
                Content::make(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make(Single::IMAGE)
                    ->collection(Single::MEDIA_COLLECTION),
                TextColumn::make(Single::TITLE)
                    ->tooltip(fn($record): string => $record->{Single::DESCRIPTION} ?? ''),
                IsVisible::make(Single::IS_VISIBLE),
            ])
            ->filters([])
            ->actions([
                ActionGroup::make([
                    ListPreviewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->groupedBulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSingles::route('/'),
            'create' => Pages\CreateSingle::route('/create'),
            'edit' => Pages\EditSingle::route('/{record}/edit'),
        ];
    }
}
