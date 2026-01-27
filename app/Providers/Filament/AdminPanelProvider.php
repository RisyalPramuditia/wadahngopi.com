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

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('WadahNgopi')
            ->brandLogo(asset('images/logo-brand.jpg'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('icons/icon-192x192.png'))
            ->colors([
                'primary' => [
                    50 => '#fffbeb',
                    100 => '#fef3c7',
                    200 => '#fde68a',
                    300 => '#fcd34d',
                    400 => '#fbbf24',
                    500 => '#f59e0b', // --color-amber
                    600 => '#d97706',
                    700 => '#b45309',
                    800 => '#92400e',
                    900 => '#78350f',
                    950 => '#451a03',
                ],
                'gray' => Color::Stone,
                'danger' => Color::Rose,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'info' => Color::Sky,
            ])
            ->font('Plus Jakarta Sans')
            ->darkMode(false) // Light mode for professional look
            ->sidebarCollapsibleOnDesktop()
            ->spa()
            ->navigationGroups([
                'Manajemen Cafe',
                'Konten & Informasi',
                'Pengaturan',
            ])
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
                        .fi-simple-main {
                            max-width: 28rem !important;
                            margin: 0 auto !important;
                        }
                        .fi-simple-layout {
                            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
                            min-height: 100vh;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }
                        .fi-logo img {
                            border-radius: 12px;
                            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                        }
                        .fi-btn-primary {
                            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
                            border: none !important;
                            font-weight: 700 !important;
                        }
                    </style>
                    <script>
                        // Auto-refresh CSRF token every 15 minutes
                        setInterval(function() {
                            fetch(\'/up\').then(response => {
                                console.log(\'Session kept alive\');
                            });
                        }, 900000);

                        // Handle 419 errors automatically
                        window.addEventListener(\'error\', function (e) {
                            if (e.message && e.message.includes(\'419\')) {
                                window.location.reload();
                            }
                        }, true);

                        // If Livewire detects an expired session, reload
                        document.addEventListener(\'livewire:init\', () => {
                            Livewire.hook(\'request\', ({ fail }) => {
                                fail(({ status, preventDefault }) => {
                                    if (status === 419) {
                                        preventDefault();
                                        window.location.reload();
                                    }
                                });
                            });
                        });
                    </script>
                ')
            );
    }
}
