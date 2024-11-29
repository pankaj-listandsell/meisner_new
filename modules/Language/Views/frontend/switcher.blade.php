@php
    $languages = \Modules\Language\Models\Language::getActive();
    $locale = session('website_locale',app()->getLocale());
@endphp
{{--Multi Language--}}
@if(!empty($languages) && setting_item('site_enable_multi_lang'))
        @foreach($languages as $language)
            @if($locale == $language->locale)
                <a href="#" data-toggle="dropdown" class="is_login">
                    @if($language->flag)
                        <span class="flag-icon flag-icon-{{$language->flag}}"></span>
                    @endif
                    {{$language->name}}
                </a>
            @endif
        @endforeach
            @foreach($languages as $language)
                @if($locale != $language->locale)
                        <a href="{{get_lang_switcher_url($language->locale)}}" class="is_login">
                            @if($language->flag)
                                <span class="flag-icon flag-icon-{{$language->flag}}"></span>
                            @endif
                            {{$language->name}}
                        </a>
                @endif
            @endforeach

@endif
{{--End Multi language--}}
