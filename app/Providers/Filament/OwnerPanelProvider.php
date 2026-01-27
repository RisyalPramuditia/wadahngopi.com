<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Models\Cafe;

class OwnerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('owner')
            ->path('owner')
            ->login()
            ->brandName('WadahNgopi | Owner')
            ->brandLogo(asset('images/logo-brand.jpg'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('icons/icon-192x192.png'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->font('Plus Jakarta Sans')
            ->tenant(Cafe::class) // Scoping by Cafe
            ->tenantProfile(\App\Filament\Pages\EditCafeProfile::class)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ->renderHook(
                'panels::body.start',
                fn () => new \Illuminate\Support\HtmlString('
                    <style>
                        .fi-simple-main { max-width: 28rem !important; margin: 0 auto !important; }
                        .fi-simple-layout { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
                        .fi-logo img { border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
                        .fi-btn-primary { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important; border: none !important; font-weight: 700 !important; }
                    </style>
                    <script>
                        setInterval(function() { fetch(\'/up\'); }, 900000);
                        document.addEventListener(\'livewire:init\', () => {
                            Livewire.hook(\'request\', ({ fail }) => {
                                fail(({ status, preventDefault }) => {
                                    if (status === 419) { preventDefault(); window.location.reload(); }
                                });
                            });
                        });
                    </script>
                ')
            );
    }
}
