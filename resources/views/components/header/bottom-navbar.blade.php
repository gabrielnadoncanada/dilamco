@props([
    'linkColor' => 'text-primary-foreground',

    'data' => []
])
<section x-data="{ offcanvasActive: false, cartActive: false }">
    <div class="bottom-navbar flex justify-between items-center">
        <div>
            <a href="/" class="py-[28px] block logo text-primary-foreground {{ $linkColor }}">
                <img height="31" width="219" alt="{{theme('tag_line')}}" src="{{Storage::url(theme('header_logo'))}}">
            </a>
        </div>
        <nav>
            @if(!empty($data->items))
                <ul class="flex items-center">
                    @foreach ($data->items as $key => $item)
                        <li class="group">
                            <a href="{{ $item['slug'] }}" data-id="{{ $key }}"
                               class="nav-link text-xl font-medium px-7 py-[34px] flex items-center gap-2 group-hover:bg-primary group-hover:text-secondary-foreground {{ $linkColor }}">
                                {{ $item['title'] }}
                                @if(!empty($item['children']))
                                    <span
                                        class="transition-all duration-500 rotate-180 group-hover:rotate-0 group-hover:text-secondary-foreground">
                                    <svg width="12" height="9" viewBox="0 0 12 9" fill="currentColor"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 8L6 2L1 8"/>
                                    </svg>
                                </span>
                                @endif
                            </a>
                            @if(!empty($item['children']))
                                <x-header.drop-down-menu :dropDownList="$item['children']" parentId="{{ $key }}"/>
                            @endif

                            {{--                        @if ($item['isMegaMenu'])--}}
                            {{--                            <x-header.mega-menu :dropDownList="$item['isMegaMenu']" parentId="{{ $item['id'] }}"/>--}}
                            {{--                        @endif--}}
                        </li>
                    @endforeach
                    <li class="other_icon text-primary-foreground px-6 cursor-pointer {{ $linkColor }}"
                        @click="offcanvasActive = true">
                        <x-icons.search height="24" width="24"/>
                    </li>
                    {{--                <li class="other_icon text-primary-foreground pl-6 cursor-pointer flex relative {{ $linkColor }}"--}}
                    {{--                    @click="cartActive = true">--}}
                    {{--                    <x-icons.shop-cart height="24" width="24"/>--}}
                    {{--                    @if (count($products) > 0)--}}
                    {{--                        <span--}}
                    {{--                            class="font-medium flex items-center justify-center text-secondary-foreground text-sm absolute -top-3 -right-4 w-6 h-6 bg-primary rounded-full">--}}
                    {{--                            {{ count($products) }}--}}
                    {{--                        </span>--}}
                    {{--                    @endif--}}
                    {{--                </li>--}}
                </ul>
            @endif
        </nav>
    </div>
    {{--        <x-offcanvas :active="offcanvasActive" @close="offcanvasActive = false" />--}}
    {{--        <x-cart :active="cartActive" @close="cartActive = false" />--}}
</section>
