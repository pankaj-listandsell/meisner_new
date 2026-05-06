<?php
namespace Modules\Products\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\FrontendController;
use Modules\Products\Models\ProductsCategory;
use Modules\Products\Models\Tag;
use Modules\Products\Models\Products;

class CategoryProductsController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $slug)
    {
        $cat = ProductsCategory::where('slug', $slug)->first();
        if (empty($cat)) {
            return redirect('/news');
        }
        $listProducts = Products::query();
        $listProducts->select("core_products.*")
                ->join('core_products_category', function ($join) use($cat) {
                    $join->on('core_products_category.id', '=', 'core_products.cat_id')
                         ->where('core_products_category._lft', '>=', $cat->_lft)
                         ->where('core_products_category._rgt', '<=', $cat->_rgt);
                })
                ->where("core_products.status", "publish")
                ->groupBy('core_products.id');


        $translation = $cat->translateOrOrigin(app()->getLocale());

        $data = [
            'rows'           => $listProducts->with("getAuthor")->with("getCategory")->paginate(5),
            'model_category'    => ProductsCategory::where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_products'        => Products::where("status", "publish"),
            'breadcrumbs'    => [
                [
                    'name' => __('Blogs'),
                    'url'  => route('news.index')
                ],
                [
                    'name'  => $translation->name,
                    'class' => 'active'
                ],
            ],
            'page_title'=>$translation->name,
            'seo_meta'  => $cat->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'translation'=>$translation,
            'header_transparent'=>true,
        ];
        return view('Products::frontend.index', $data);
    }
}
