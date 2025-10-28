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
use Filament\Navigation\MenuItem;
use App\Filament\Pages\EditProfile; 
use Filament\Support\Icons\Heroicon;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->brandName('Pitstop Pertamina')
            ->favicon(asset('favicon.png'))
            ->login()
            ->sidebarFullyCollapsibleOnDesktop()
            // ->topNavigation() // untuk navbar atas
            ->spa(hasPrefetching: true)
            ->registration()             
            ->userMenuItems([
                MenuItem::make()
                    ->label('Profile')
                    ->icon('heroicon-m-user-circle')
                    ->url(fn (): string => EditProfile::getUrl()),
            ])
            ->colors([
                'primary' => Color::Blue,
            ]) 
//              ->renderHook(PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, fn () => view('auth.login-extra'))
//         // SEMBUNYIKAN baris subheading (“or …”) di semua layout (page & simple)
//       ->renderHook(PanelsRenderHook::STYLES_AFTER, function () {
//     // Path relatif dari Filament (tanpa host). Ini aman, tapi nanti kita normalisasi di JS.
//     $loginPath    = parse_url(route('filament.dashboard.auth.login',    [], false), PHP_URL_PATH);
//     $registerPath = parse_url(route('filament.dashboard.auth.register', [], false), PHP_URL_PATH);

//     $loginJson    = json_encode($loginPath);
//     $registerJson = json_encode($registerPath);

//     return new HtmlString(<<<HTML
// <style>
// /* Sembunyikan subheading default “or …” DI MANA PUN */
// .fi-auth-card header h1 + *, .fi-simple-main header h1 + * { display: none !important; }

// /* CTA footer (pusat) */
// .auth-footer-wrap{ display:flex; justify-content:center; width:100%; margin-top:1rem; }
// .auth-footer-row{ margin:0 auto; text-align:center; font-size:.875rem; color:rgb(75 85 99); }
// .auth-footer-link{ color:rgb(37 99 235); text-decoration:underline; }
// .auth-footer-link:hover{ text-decoration:none; }
// </style>

// <script>
// (function () {
//   var LOGIN_PATH    = $loginJson;     // ex: "/dashboard/login"
//   var REGISTER_PATH = $registerJson;  // ex: "/dashboard/register"

//   // Normalisasi pathname: buang prefix "/public" jika ada
//   function normalizedPathname() {
//     var p = location.pathname || '/';
//     return p.replace(/^\\/public(?![^/])|^\\/public\\//, '/');
//   }

//   function pageKind() {
//     var p = normalizedPathname();
//     if (p.startsWith(LOGIN_PATH))    return 'login';
//     if (p.startsWith(REGISTER_PATH)) return 'register';
//     return 'other';
//   }

//   function setHeading() {
//     var h1 = document.querySelector('.fi-auth-card header h1, .fi-simple-main header h1');
//     if (!h1) return;
//     var kind = pageKind();
//     if (kind === 'login')    h1.textContent = 'Masuk';
//     if (kind === 'register') h1.textContent = 'Daftar';
//   }

//   function ensureFooter() {
//     var kind = pageKind();
//     if (kind !== 'login' && kind !== 'register') return;

//     var card = document.querySelector('.fi-auth-card, .fi-simple-main');
//     if (!card) return;

//     var old = card.querySelector('.auth-footer-wrap');
//     if (old) old.remove();

//     var text, linkText, href;
//     if (kind === 'login') {
//       text = 'Belum punya akun?';
//       linkText = 'Buat akun baru';
//       href = REGISTER_PATH;
//     } else {
//       text = 'Sudah punya akun?';
//       linkText = 'Masuk sini';
//       href = LOGIN_PATH;
//     }

//     var wrap = document.createElement('div');
//     wrap.className = 'auth-footer-wrap';
//     wrap.innerHTML =
//       '<p class="auth-footer-row">' +
//         text + ' ' +
//         '<a class="auth-footer-link" href="' + href + '">' + linkText + '</a>' +
//       '</p>';

//     var form = card.querySelector('form');
//     (form && form.parentNode ? form.parentNode : card).appendChild(wrap);
//   }

//   function run() {
//     setHeading();      // ganti "Sign in" ↔ "Sign up"
//     ensureFooter();    // pasang CTA bawah & pusatkan
//     // Subheading default sudah dihilangkan via CSS global di atas.
//   }

//   // Initial + navigasi Livewire/SPA
//   if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', run); else run();
//   window.addEventListener('livewire:navigated', run);
//   var root = document.querySelector('.fi-auth-card, .fi-simple-main');
//   if (root) new MutationObserver(run).observe(root, { childList: true, subtree: true });
//   var last = location.pathname;
//   setInterval(function(){ if (location.pathname !== last) { last = location.pathname; run(); } }, 300);
// })();
// </script>
// HTML);
// })
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
                EditProfile::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
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
                FilamentBackgroundsPlugin::make()
                    // gunakan gambar sendiri dari public/images/auth-backgrounds
                    ->imageProvider(
                        MyImages::make()->directory('images/swisnl/filament-backgrounds/triangles')
                    )
                    // cache 15 menit supaya ringan
                    ->remember(900)
                    // kalau mau sembunyikan atribusi (tidak direkomendasikan kalau lisensinya mewajibkan kredit):
                    // ->showAttribution(false)
            ])
            ->authMiddleware([
                Authenticate::class,
                EnsureEmailIsVerified::class,
            ])
            ->passwordReset()
            ->emailVerification()
            
            ;
    }
}
