<?php

namespace Modules\Page\Imports;

class PageSeo
{
    const PAGE_TYPE = 'page';
    const PAGE_TRANSLATION_TYPE = 'page_translation';

    public $id;
    public $type;
    public $locale;
    public $slug;
    public $slugAffix;
    public $seoTitle;
    public $seoDescription;

    public function __construct(int $id, string $locale, string $slug, string $seoTitle, string $seoDescription)
    {
        $this->id = $id;
        $this->type = $locale == get_default_lang() ? self::PAGE_TYPE : self::PAGE_TRANSLATION_TYPE;
        $this->locale = $locale;
        $this->seoTitle = $seoTitle;
        $this->seoDescription = $seoDescription;
        $this->setSlug($slug);
    }

    private function setSlug($slug)
    {
        $slugs = explode('/', $slug);
        $this->slug = $slugs[0];
        $this->slugAffix = $slugs[1] ?? '';
    }
}