<?php

namespace App\Filament\Resources;

use App\Filament\Fields\PhoneInput;
use App\Filament\Fields\TimeStampSection;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Tables\Actions\SoftDeleteAction;
use App\Filament\Tables\Actions\SoftDeleteBulkAction;
use App\Models\User;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $recordTitleAttribute = 'users';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make(User::FIRST_NAME)
                                    ->required(),
                                TextInput::make(User::LAST_NAME)
                                    ->required(),
                                TextInput::make(User::EMAIL)
                                    ->email()
                                    ->unique(ignoreRecord: true)
                                    ->required(),
                                PhoneInput::make(User::PHONE)
                                    ->default(null),
                                Textarea::make(User::NOTE)
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ])
                            ->columns()
                            ->columnSpan(1),
                        Section::make(__('filament.sections.password'))
                            ->collapsible()
                            ->collapsed(fn ($record) => $record)
                            ->schema(static::getPasswordFormComponent()),
                    ])
                    ->columnSpan(['lg' => fn ($record) => $record === null ? 3 : 2]),
                TimeStampSection::make()->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(User::FIRST_NAME)
                    ->sortable()
                    ->searchable(),
                TextColumn::make(User::LAST_NAME)
                    ->sortable()
                    ->searchable(),
                TextColumn::make(User::EMAIL)
                    ->sortable()
                    ->searchable(),
                TextColumn::make(User::PHONE)
                    ->sortable()
                    ->searchable(),
                TextColumn::make(User::EMAIL_VERIFIED_AT)
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make(User::CREATED_AT)
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make(User::UPDATED_AT)
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                ViewAction::make(),
                Tables\Actions\EditAction::make(),
                SoftDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    SoftDeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    protected static function getPasswordFormComponent(): array
    {
        return [
            TextInput::make(User::PASSWORD)
                ->password()
                ->required(fn (?User $record) => $record === null)
                ->rule(Password::default())
                ->autocomplete('new-password')
                ->dehydrated(fn ($state): bool => filled($state))
                ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                ->live(debounce: 500)
                ->same('passwordConfirmation'),
            TextInput::make('passwordConfirmation')
                ->label('Confirmation du mot de passe')
                ->password()
                ->required()
                ->visible(fn (Get $get): bool => filled($get('password')))
                ->dehydrated(false),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.group.administration');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
