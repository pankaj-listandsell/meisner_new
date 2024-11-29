<?php
namespace Modules\Page\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Modules\AdminController;
use Modules\News\Models\News;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\Page\Models\Page;
use Modules\Page\Models\PageTranslation;

class PageController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data = [
            'rows' => Page::paginate(20),
        ];
        return view('Page::frontend.index', $data);
    }


    /**
     * Home Page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function homePage()
    {
        $home_page_id = setting_item('home_page_id');

        $page = Page::where("id",$home_page_id)->where("status","publish")->first();
        $locale = get_current_lang();
        $slug = request()->route('slug');

        if (in_array($slug, get_language_codes())) {
            $locale = $slug;
        }

        if($home_page_id && $page)
        {
            $this->setActiveMenu($page);
            $translation = $page->translateOrOrigin($locale);
            $seo_meta = $page->getSeoMetaWithTranslation($locale, $translation);
            $seo_meta['full_url'] = url("/");
            $seo_meta['is_homepage'] = true;
            $data = [
                'row'=>$page,
                "seo_meta"=> $seo_meta,
                'translation'=>$translation,
                'is_home' => true,
            ];

            return view('Page::frontend.detail',$data);
        }


        $model_News = News::where("status", "publish");
        $data = [
            'rows'=>$model_News->paginate(5),
            'model_category'    => NewsCategory::where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish"),
            'breadcrumbs' => [
                ['name' => __('News'), 'url' => url("/news") ,'class' => 'active'],
            ],
            "seo_meta" => News::getSeoMetaForPageList()
        ];
        return view('News::frontend.index',$data);
    }


    /**
     * Frontend Pages
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail()
    {
        $slug = request()->route('slug');
        $branch = (string) request()->route('branch');
        $locale = get_default_lang();

        if (in_array($slug, get_language_codes())) {
            return $this->homePage();
        }

        // $page = Page::where('core_pages.slug', $slug)->first();

        // if (!$page) {
        //     $page = Page::select('*','core_pages.id')->join('core_page_translations', 'core_pages.id', 'core_page_translations.origin_id')
        //         ->Where('core_page_translations.slug', $slug)
        //         ->first();

        //     if ($page) {
        //         $locale = $page->locale;
        //     }
        // }

        $page = Page::where('core_pages.slug', $slug)
            ->where(function ($query) use ($branch) {
                if ($branch != '') {
                    $query->where('slug_affix', $branch);
                } else {
                    $query->where('slug_affix', '=', NULL)->orWhere('slug_affix', '=', '');
                }
            })
            ->first();

        if (!$page) {
            $page = Page::select('*','core_pages.id')
                ->join('core_page_translations', 'core_pages.id', 'core_page_translations.origin_id')
                ->where('core_page_translations.slug', $slug)
                ->where(function ($query) use ($branch) {
                    if ($branch != '') {
                        $query->where('core_page_translations.slug_affix', $branch);
                    } else {
                        $query->where('core_page_translations.slug_affix', '=', NULL)
                            ->orWhere('core_page_translations.slug_affix', '=', '');
                    }
                })
                ->first();

            if ($page) {
                $locale = $page->locale;
                $showLanguageBar = true;
            }
        }

        if (empty($page) || !$page->is_published) {
            abort(404);
        }

        $translation = $page->translateOrOrigin($locale);

        $data = [
            'row' => $page,
            'translation' => $translation,
            'seo_meta'  => $page->getSeoMetaWithTranslation($locale, $translation),
            'body_class'  => "page",
            // 'breadcrumbs' => [
            //     [
            //         'name' => setting_item_with_lang('site_title',request()->query('lang')),
            //         'url'  => route('home')
            //     ],
            //     [
            //         'name'  => $translation->title,
            //         'class' => 'active'
            //     ],
            // ],
        ];
        if(!empty($page->header_style) and $page->header_style == "transparent"){
            $data['header_transparent'] = true;
        }
       // dd($data);
        return view('Page::frontend.detail', $data);
    }
}
