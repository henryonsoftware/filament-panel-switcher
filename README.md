# Filament Panel Switcher

A [Filament](https://filamentphp.com) plugin that adds a panel navigation switcher to the topbar, letting users move between multiple Filament panels without leaving the admin UI.

- Desktop: horizontal tab-style links after the brand logo
- Mobile: a dropdown triggered by the active panel's icon

## Requirements

- PHP 8.3+
- Filament 4.x
- Laravel 12.x

## Installation

```bash
composer require henryonsoftware/filament-panel-switcher
```

Publish the config file:

```bash
php artisan vendor:publish --tag=filament-panel-switcher-config
```

## Usage

Register the plugin in each panel provider where the switcher should appear:

```php
use HenryOnSoftware\FilamentPanelSwitcher\FilamentPanelSwitcherPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugin(FilamentPanelSwitcherPlugin::make());
}
```

Add your panels to `config/filament-panel-switcher.php`:

```php
return [
    'panels' => [
        'admin' => [
            'label' => 'Admin',
            'icon'  => 'heroicon-o-cog-8-tooth',
        ],
        'app' => [
            'label' => 'App',
            'icon'  => 'heroicon-o-home',
        ],
    ],
];
```

Keys are your panel IDs (set via `->id('...')` in the panel provider). Both `label` and `icon` are optional — the label defaults to the title-cased panel ID, and the icon is omitted if not set.

## Styling

Publish the CSS file and include it in your Filament theme:

```bash
php artisan vendor:publish --tag=filament-panel-switcher-css
```

This copies `panel-switcher.css` to `resources/css/filament-panel-switcher.css`. Add an import to your theme CSS file:

```css
@import '../filament-panel-switcher.css';
```

The stylesheet uses `@apply` directives (Tailwind CSS) and three CSS custom variables. Define these in your theme to match your design:

```css
:root {
    --switcher-muted-foreground: oklch(0.552 0.016 285.938);
    --switcher-accent: oklch(0.967 0.001 286.375);
    --switcher-accent-foreground: oklch(0.21 0.006 285.885);
}
```

## Customising Views

Publish the views to override the markup:

```bash
php artisan vendor:publish --tag=filament-panel-switcher-views
```

This copies the templates to `resources/views/vendor/filament-panel-switcher/`.

## Custom Config Key

If your project already stores panel metadata under a different config key, you can point the plugin at it instead of the default `filament-panel-switcher.panels`:

```php
FilamentPanelSwitcherPlugin::make()->configKey('my-config.panels')
```

## Access Control

The switcher respects each panel's built-in access control. It calls `$user->canAccessPanel($panel)` and only renders panels the authenticated user can access. Implement this method on your `User` model:

```php
use Filament\Panel;

public function canAccessPanel(Panel $panel): bool
{
    return match ($panel->getId()) {
        'admin'  => $this->isAdmin(),
        default  => true,
    };
}
```

## License

MIT
