<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use App\Settings\GeneralSetting;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Filament\Http\Middleware\Authenticate;
use App\Http\Middleware\ForcePasswordChange;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\Pages\Auth\RequestPasswordReset;
use Filament\Http\Middleware\AuthenticateSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws \Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->brandName('Portal Layanan E-Gov')
            ->favicon($this->getFavicon())
            // ->spa(config('app.spa'))
            // ->spaUrlExceptions(fn (): array => [
            //     AgendaResource::class::getUrl(),
            //     MenuResource::class::getUrl(),
            //     LocationSetting::class::getUrl(),
            //     EmployeeResource::class::getUrl(),
            // ])
            ->id('admin')
            ->path('admin')
            ->login()            
            ->databaseTransactions()
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->passwordReset(RequestPasswordReset::class)            
            ->widgets([])
            ->maxContentWidth(MaxWidth::Full)
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
            ->font('Quicksand')
            ->colors([
                'danger' => Color::Neutral,
                'gray' => Color::Neutral,
                'info' => Color::Amber,
                'primary' => Color::Neutral,
                'success' => Color::Lime,
                'warning' => Color::Amber,
            ])
            ->sidebarWidth('18rem')
            ->navigationGroups([
                'Layanan E-Government',
                'Fitur Portal',
                'Manajemen E-Gov',
                'Lainnya',
                'Pengaturan',
            ])
            ->plugins([
                FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'lg' => 2,
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 4,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
            ])
            ->authMiddleware([
                Authenticate::class,
                ForcePasswordChange::class,
            ]);
    }

    private function getFavicon(): string
    {
        try {
            if (! Schema::hasTable('settings')) {
                return '';
            }
            $pengaturan = new GeneralSetting;

            if (! $pengaturan->favicon) {
                return '';
            }

            return Storage::disk('public')->url($pengaturan->favicon) ?? '';
        } catch (\Exception $exception) {
            return '';
        }
    }
}
