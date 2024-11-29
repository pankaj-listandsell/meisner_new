<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Page\Models\Page;
use Modules\Page\Models\PageTranslation;

class UpdatePageContentToGrapes extends Command
{
    protected $signature = 'update:grapes_content';

    protected $description = 'Update page content to grapes';

    public function handle()
    {
        $pages = Page::all();
        foreach ($pages as $page) {
            $content = str_replace('uploads/0000', 'storage/uploads/0000', $page->content);
            $page->content = $content;
            //$page->gjs_data = $this->getGrapeData($content);
            $page->save();
        }
        $pageTranslations = PageTranslation::all();
        foreach ($pageTranslations as $page) {
            $content = str_replace('uploads/0000', 'storage/uploads/0000', $page->content);
            $page->content = $content;
            //$page->gjs_data = $this->getGrapeData($content);
            $page->save();
        }
    }

    public function getGrapeData($content): array
    {
        return [
            'components' => [],
            'styles' => [],
            'css' => '',
            'html' => $content,
        ];
    }
}
