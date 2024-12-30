<?php

namespace App\Filament\Pages;

use App\Filament\Fields\MenuSelect;
use App\Filament\Fields\PageSelect;
use App\Filament\Fields\UrlSelectionField;
use App\Settings\ThemeSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageTheme extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = ThemeSettings::class;

    protected static ?int $navigationSort = 5;

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->schema(static::generalTabSchema()),
                        Tabs\Tab::make('Header')
                            ->schema(static::headerTabSchema()),
                        Tabs\Tab::make('Footer')
                            ->schema(static::footerTabSchema()),
                        Tabs\Tab::make('Post')
                            ->schema(static::pageTabSchema()),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function generalTabSchema(): array
    {
        return [
            TextInput::make('title')
                ->label('Title'),
            TextInput::make('tag_line')
                ->label('Tag Line'),
            FileUpload::make('default_image')
                ->image()
                ->label('Default Image'),
            FileUpload::make('favicon')
                ->image()
                ->label('Favicon'),
            KeyValue::make('social_links')
                ->keyLabel('Name')
                ->valueLabel('Link'),
        ];
    }

    public static function headerTabSchema(): array
    {
        return [
            MenuSelect::make('header_menu_id'),
            FileUpload::make('header_logo')
                ->image()
                ->label('Header logo'),
            Toggle::make('header_top_bar_enabled'),
            Toggle::make('header_top_bar_social_links_enabled'),
            UrlSelectionField::make('header_top_bar_action')
                ->columnSpanFull(),
        ];
    }

    public static function footerTabSchema(): array
    {
        return [
            MenuSelect::make('footer_menu_id'),
            FileUpload::make('footer_logo')
                ->image()
                ->label('Footer logo'),
        ];
    }

    public static function pageTabSchema(): array
    {
        return [
            PageSelect::make('home_page_id'),
            PageSelect::make('blog_page_id'),
            PageSelect::make('service_page_id'),
            PageSelect::make('project_page_id'),
            PageSelect::make('career_page_id'),
            PageSelect::make('team_page_id'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.group.administration');
    }
}
