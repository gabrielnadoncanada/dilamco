<x-layouts.app :meta="$record->meta ?? false">
    <x-header.header-one/>
    <main>
        @if(!empty($record->builder->content))
            @foreach(array_keys($record->builder->content) as $section)
                @if(!empty($record->builder->content[$section]))
                    <div data-content="{{ $section }}">
                        <x-filament-builder::sections :sections="$record->builder->content[$section]"/>
                    </div>
                @endif
            @endforeach
        @endif
    </main>
    <x-footer/>
</x-layouts.app>
