<?php

namespace HenryOnSoftware\FilamentPanelSwitcher;

use Illuminate\Support\Str;

class PanelSwitcher
{
    public static function build(
        iterable $panels,
        callable $canAccess,
        ?string $currentPanelId,
        string $configKey = 'filament-panel-switcher.panels',
    ): array {
        $result = [];

        foreach ($panels as $panel) {
            if (! $canAccess($panel)) {
                continue;
            }

            $id = $panel->getId();
            $config = config("{$configKey}.{$id}", []);

            $result[] = [
                'id' => $id,
                'label' => $config['label'] ?? Str::title($id),
                'icon' => $config['icon'] ?? null,
                'url' => $panel->getUrl() ?? '',
                'is_active' => $id === $currentPanelId,
            ];
        }

        return $result;
    }
}
