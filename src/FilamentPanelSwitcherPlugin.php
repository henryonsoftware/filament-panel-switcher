<?php

namespace HenryOnSoftware\FilamentPanelSwitcher;

use Filament\Contracts\Plugin;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;

class FilamentPanelSwitcherPlugin implements Plugin
{
    protected string $configKey = 'filament-panel-switcher.panels';

    public static function make(): static
    {
        return app(static::class);
    }

    public function configKey(string $configKey): static
    {
        $this->configKey = $configKey;

        return $this;
    }

    public function getId(): string
    {
        return 'panel-switcher';
    }

    public function register(Panel $panel): void {}

    public function boot(Panel $panel): void
    {
        $resolvePanels = function (): array {
            $user = Filament::auth()->user();

            if ($user === null) {
                return [];
            }

            return PanelSwitcher::build(
                Filament::getPanels(),
                fn ($p) => $user->canAccessPanel($p),
                Filament::getCurrentPanel()?->getId(),
                $this->configKey,
            );
        };

        FilamentView::registerRenderHook(
            PanelsRenderHook::TOPBAR_LOGO_AFTER,
            fn (): string => view('filament-panel-switcher::panel-switcher', ['panels' => $resolvePanels()])->render(),
            scopes: $panel->getId(),
        );

        FilamentView::registerRenderHook(
            PanelsRenderHook::TOPBAR_START,
            fn (): string => view('filament-panel-switcher::panel-switcher-mobile', ['panels' => $resolvePanels()])->render(),
            scopes: $panel->getId(),
        );
    }
}
