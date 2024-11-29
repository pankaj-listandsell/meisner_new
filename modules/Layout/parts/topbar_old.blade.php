{{-- @if(Auth::check()) --}}
<div class="bravo_topbar">
    <div class="container">
        <div class="content">
            <div class="topbar-left">
                {!! setting_item_with_lang("topbar_left_text") !!}
            </div>
        </div>
        @if(isset($show_language_bar) && $show_language_bar)
            <div class="switcher_wrapper">
                @include('Language::frontend.switcher')
            </div>
        @endif
    </div>
</div>
{{-- @endif --}}
