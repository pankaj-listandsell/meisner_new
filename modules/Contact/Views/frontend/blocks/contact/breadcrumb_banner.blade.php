<?php
$slug = request()->route('slug');
$lang = request()->route('lang');

if (is_current_lang_default_lang($lang)) {
    $page = \Modules\Page\Models\Page::where('slug', $slug)->first();
} else {
    $page = \Modules\Page\Models\PageTranslation::select('core_page_translations.title')
        ->where('core_page_translations.slug', $slug)
        ->first();
}
$image_url = get_file_url($bg_image, 'full')
?>
<div class="leistungen-bg-color">
    <div class="leistungen-banner" style="background:url('{{ $image_url }}');">
        <div class="container">
            <p><a href='/'>{{ setting_item_with_lang('site_title',request()->query('lang')) }}</a> {{ ' / '}} {!! $page ? clean($page->title) : '' !!} </p>
            <div class="banner-heading">{!! $page ? clean($page->title) : '' !!}</div>
        </div>
    </div>
</div>
