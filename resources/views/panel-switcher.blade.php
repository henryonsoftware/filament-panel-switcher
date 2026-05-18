@props(['panels' => []])

@if (! empty($panels))
    <nav aria-label="Panel switcher" class="fi-panel-switcher">
        @foreach ($panels as $panel)
            <a href="{{ $panel['url'] }}" class="fi-panel-switcher-item"
                @if ($panel['is_active']) aria-current="page" @endif
            >
                @if ($panel['icon'])
                    @svg($panel['icon'], 'fi-panel-switcher-icon')
                @endif
                <span>{{ $panel['label'] }}</span>
            </a>
        @endforeach
    </nav>
@endif
