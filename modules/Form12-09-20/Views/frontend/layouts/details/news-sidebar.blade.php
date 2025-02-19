<aside class="sidebar-right">
    @php
        $list_sidebars = setting_item_with_lang("news_sidebar");
    @endphp
    @if($list_sidebars)
        @php
            $list_sidebars = json_decode($list_sidebars);
        @endphp
        @foreach($list_sidebars as $item)
            @if(!in_array($item->type, avoidNewsLayouts()))
                @include('News::frontend.layouts.sidebars.'.$item->type)
            @endif
        @endforeach
    @endif
</aside>
