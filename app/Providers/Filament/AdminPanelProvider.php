<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Illuminate\Support\HtmlString;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\View\PanelsRenderHook;
use CraftForge\FilamentLanguageSwitcher\FilamentLanguageSwitcherPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('Pitstop Pertamina')
            ->login()
            ->profile()                    
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->brandLogo(fn () => new HtmlString(
        '<img src="'.asset('images/logo.png').'" alt="Pitstop Pertamina" class="h-6 w-auto">'
    ))
    ->darkModeBrandLogo(fn () => new HtmlString(
        '<img src="'.asset('images/logo.png').'" alt="Pitstop Pertamina" class="h-6 w-auto">'
    ))
    ->brandLogoHeight('100px')
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
            ->plugins([
                FilamentShieldPlugin::make(),
                    FilamentLanguageSwitcherPlugin::make()
        ->locales([
            // name & flag opsional — plugin bisa mengenerate otomatis
            ['code' => 'id', 'name' => 'Bahasa Indonesia', 'flag' => 'id'],
            ['code' => 'en', 'name' => 'English',           'flag' => 'gb'],
        ])
        ->showFlags(true) // atau false kalau mau teks saja
        ->renderHook(PanelsRenderHook::USER_MENU_PROFILE_AFTER),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
