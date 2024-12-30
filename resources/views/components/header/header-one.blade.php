<header {{$attributes->merge(['class' => 'absolute z-[60] top-0 left-0 w-full bg-gray overflow-x-clip header-one'])}}>
    @if(theme('header_top_bar_enabled'))
        <div class="hidden xl:block">
            <x-header.top-navbar/>
        </div>
    @endif
    <div class="border-border border-t border-b hidden xl:block">
        <div class="container-fluid">
            @php
                $menu =  App\Models\Navigation::find(app(App\Settings\ThemeSettings::class)->header_menu_id);
            @endphp
            <x-header.bottom-navbar :data="$menu"/>
        </div>
    </div>
    <div class="xl:hidden block">
        {{--        <x-header.mobile-navbar />--}}
    </div>
</header>
