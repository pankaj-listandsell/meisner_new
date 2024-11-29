<?php
namespace Modules\Products\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Language\Models\Language;
use Modules\Products\Models\ProductsCategory;
use Modules\Products\Models\Products;
use Modules\Products\Models\ProductsTranslation;

class ProductsController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('products.admin.index'));
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('products_view');
        $dataProducts = Products::query()->orderBy('id', 'desc');
        $post_name = $request->query('s');
        $cate = $request->query('cate_id');
        if ($cate) {
           $dataProducts->where('cat_id', $cate);
        }
        if ($post_name) {
            $dataProducts->where('title', 'LIKE', '%' . $post_name . '%');
            $dataProducts->orderBy('title', 'asc');
        }


        $this->filterLang($dataProducts);

        $data = [
            'rows'        => $dataProducts->with("getAuthor")->with("getCategory")->paginate(20),
            'categories'  => ProductsCategory::get(),
            'breadcrumbs' => [
                [
                    'name' => __('Products'),
                    'url'  => route('products.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            "languages"=>Language::getActive(false),
            "locale"=>\App::getLocale(),
            'page_title'=>__("Products Management")
        ];
        return view('Products::admin.products.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('products_create');
        $row = new Products();
        $row->fill([
            'status' => 'publish',
        ]);
        $data = [
            'categories'        => ProductsCategory::get()->toTree(),
            'row'         => $row,
            'breadcrumbs' => [
                [
                    'name' => __('Product'),
                    'url'  => route('products.admin.index')
                ],
                [
                    'name'  => __('Add Product'),
                    'class' => 'active'
                ],
            ],
            'translation'=>new ProductsTranslation()
        ];
        return view('Products::admin.products.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('products_update');

        $row = Products::find($id);

        $translation = $row->translateOrOrigin($request->query('lang'));

        if (empty($row)) {
            return redirect(route('products.admin.index'));
        }

       

        $data = [
            'row'  => $row,
            'translation'  => $translation,
            'categories' => ProductsCategory::get()->toTree(),
            'enable_multi_lang'=>true
        ];
        return view('Products::admin.products.detail', $data);
    }

    public function store(Request $request, $id){
        if(is_demo_mode()){
            return redirect()->back()->with('danger',__("DEMO MODE: Disable update"));
        }
        if($id>0){
            $this->checkPermission('products_update');
            $row = Products::find($id);
            if (empty($row)) {
                return redirect(route('products.admin.index'));
            }
        }else{
            $this->checkPermission('products_create');
            $row = new Products();
            $row->status = "publish";
        }

        $row->fill($request->input());
        if($request->input('slug')){
            $row->slug = $request->input('slug');
        }
        $res = $row->saveOriginOrTranslation($request->query('lang'),true);

        if ($res) {

            if($id > 0 ){
                return back()->with('success',  __('Products updated') );
            }else{
                return redirect(route('products.admin.edit',$row->id))->with('success', __('Products created') );
            }
        }
    }

    public function bulkEdit(Request $request)
    {
        if(is_demo_mode()){
            return redirect()->back()->with('danger',__("DEMO MODE: Disable update"));
        }
        $this->checkPermission('products_update');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = Products::where("id", $id);
                if (!$this->hasPermission('products_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('products_delete');
                }
                $query->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = Products::where("id", $id);
                if (!$this->hasPermission('products_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('products_update');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }

    public function trans($id,$locale){
        $row = Products::find($id);

        if(empty($row)){
            return redirect()->back()->with("danger",__("Products does not exists"));
        }

        $translated = Products::query()->where('origin_id',$id)->where('lang',$locale)->first();
        if(!empty($translated)){
            redirect($translated->getEditUrl());
        }

        $language = Language::where('locale',$locale)->first();
        if(empty($language)){
            return redirect()->back()->with("danger",__("Language does not exists"));
        }

        $product = $row->replicate();

        if(!$row->origin_id){
            $product->origin_id = $row->id;
        }

        $product->lang = $locale;

        $product->save();


        return redirect($product->getEditUrl());
    }
}
