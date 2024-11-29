<div class="breadcrumb-wrapper">
    <div class="breadcrumb-div container">

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
        ?>

        <a href='/'>{{ setting_item_with_lang('site_title',request()->query('lang')) }}</a> {{ ' / '}} {!! $page ? clean($page->title) : '' !!}
    </div>
</div>
