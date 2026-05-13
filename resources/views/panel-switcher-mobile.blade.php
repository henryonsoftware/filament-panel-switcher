@props(['panels' => []])

@php
    $activePanel = collect($panels)->firstWhere('is_active', true) ?? ($panels[0] ?? null);
@endphp

@if (! empty($panels) && $activePanel)
    <div class="fi-panel-switcher-mobile lg:hidden me-1">
        <x-filament::dropdown placement="bottom-start" teleport>
            <x-slot name="trigger">
                <button
                    type="button"
                    aria-label="Switch panel ({{ $activePanel['label'] }})"
                    class="fi-panel-switcher-mobile-trigger"
                >
                    @if ($activePanel['icon'])
                        @svg($activePanel['icon'], 'size-5 shrink-0')
                    @else
                        @svg('heroicon-o-squares-2x2', 'size-5 shrink-0')
                    @endif
                </button>
            </x-slot>

            <x-filament::dropdown.list>
                @foreach ($panels as $panel)
                    <x-filament::dropdown.list.item
                        :href="$panel['url']"
                        :icon="$panel['icon']"
                        tag="a"
                        :color="$panel['is_active'] ? 'primary' : 'gray'"
                    >
                        {{ $panel['label'] }}
                    </x-filament::dropdown.list.item>
                @endforeach
            </x-filament::dropdown.list>
        </x-filament::dropdown>
    </div>
@endif
