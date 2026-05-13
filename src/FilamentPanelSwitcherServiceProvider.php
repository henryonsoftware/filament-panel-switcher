<?php

namespace HenryOnSoftware\FilamentPanelSwitcher;

use Illuminate\Support\ServiceProvider;

class FilamentPanelSwitcherServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-panel-switcher');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/filament-panel-switcher'),
        ], 'filament-panel-switcher-views');

        $this->publishes([
            __DIR__.'/../resources/css/panel-switcher.css' => resource_path('css/filament-panel-switcher.css'),
        ], 'filament-panel-switcher-css');

        $this->publishes([
            __DIR__.'/../config/filament-panel-switcher.php' => config_path('filament-panel-switcher.php'),
        ], 'filament-panel-switcher-config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filament-panel-switcher.php', 'filament-panel-switcher');
    }
}
