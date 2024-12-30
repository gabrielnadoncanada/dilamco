@php
    $header_top_bar_social_links_enabled = theme('header_top_bar_social_links_enabled');
    $header_top_bar_action = theme('header_top_bar_action');
@endphp

<div class="container-fluid py-4 flex justify-between items-center">
    @if($header_top_bar_social_links_enabled)
        <div class="pr-5">
            <x-ui.social-media-list/>
        </div>
    @endif
{{--    @if(!empty($header_top_bar_action))--}}
{{--        <div class="flex items-center gap-[20px] divide-x divide-black">--}}
{{--            <x-ui.buttons.button-outline class="py-1 after:left-0 ">--}}
{{--                {{$header_top_bar_action['title']}}--}}
{{--                <x-icons.right-arrow height="22" width="35"/>--}}
{{--            </x-ui.buttons.button-outline>--}}


{{--            <p class="font-bold"><span>Call Us:</span> +(1800)456-7890</p>--}}
{{--        </div>--}}
{{--    @endif--}}
</div>
