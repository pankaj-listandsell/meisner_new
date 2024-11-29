<?php

namespace Modules\Page\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Modules\Core\Models\SEO;
use Modules\Page\Models\Page;
use function Symfony\Component\String\s;

class PageSeoExport implements FromView
{

    public function view(): View
    {
        return view('Page::admin.exports.page_seo', [
            'pages' => (new Page())->getPagesWithLanguage(),
        ]);
    }

}