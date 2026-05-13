@props(['panels' => []])

@if (! empty($panels))
    <nav aria-label="Panel switcher" class="fi-panel-switcher hidden lg:flex items-center gap-3 h-full">
        @foreach ($panels as $panel)
            <a href="{{ $panel['url'] }}" class="fi-panel-switcher-item"
                @if ($panel['is_active']) aria-current="page" @endif
            >
                @if ($panel['icon'])
                    @svg($panel['icon'], 'size-4 shrink-0')
                @endif
                <span>{{ $panel['label'] }}</span>
            </a>
        @endforeach
    </nav>
@endif
