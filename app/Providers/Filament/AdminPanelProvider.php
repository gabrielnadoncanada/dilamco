<?php

namespace App\Providers\Filament;

use App\Filament\Clusters\Contents\Resources\SingleResource;
use App\Filament\Pages\Auth\Login;
use App\Settings\ThemeSettings;
use Devlense\FilamentBuilder\FilamentBuilderPlugin;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return
            $panel
                ->default()
                ->id('admin')
                ->brandName('')
                ->path('admin')
                ->login(Login::class)
                ->colors([

                ])
                ->viteTheme('resources/css/filament/admin/theme.css')
                ->sidebarFullyCollapsibleOnDesktop()
//            ->brandLogo(Storage::url(app(ThemeSettings::class)->site_logo))
//            ->darkModeBrandLogo(Storage::url(app(ThemeSettings::class)->site_logo))
//            ->brandLogoHeight('1.25rem')
                ->font('DM Sans', provider: GoogleFontProvider::class)
                ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
                ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
                ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
                ->pages([
                ])
                ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
                ->widgets([
                    Widgets\AccountWidget::class,
                    Widgets\FilamentInfoWidget::class,
                ])

                ->middleware([
                    EncryptCookies::class,
                    AddQueuedCookiesToResponse::class,
                    StartSession::class,
                    AuthenticateSession::class,
                    ShareErrorsFromSession::class,
                    VerifyCsrfToken::class,
                    SubstituteBindings::class,
                    DisableBladeIconComponents::class,
                    DispatchServingFilamentEvent::class,
                ])
                ->authMiddleware([
                    Authenticate::class,
                ])

                ->plugins([
                    SpatieLaravelTranslatablePlugin::make()->defaultLocales(['fr', 'en']),
                    FilamentBuilderPlugin::make(),
                ]);
//                ->viteTheme('resources/css/filament/app/theme.css')

    }
}
