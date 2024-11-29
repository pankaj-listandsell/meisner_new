<?php
namespace Modules\Products\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Products\Models\ProductsCategory;
use Illuminate\Support\Str;
use Modules\Products\Models\ProductsCategoryTranslation;

class CategoryController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('products.admin.index'));
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('products_manage_others');

        $catlist = new ProductsCategory;
        if ($catename = $request->query('s')) {
            $catlist = $catlist->where('name', 'LIKE', '%' . $catename . '%');
        }
        $catlist = $catlist->orderby('name', 'asc');
        $rows = $catlist->get();

        $data = [
            'rows'        => $rows->toTree(),
            'row'         => new ProductsCategory(),
            'breadcrumbs' => [
                [
                    'name' => __('Products'),
                    'url'  => route('products.admin.index')
                ],
                [
                    'name'  => __('Category'),
                    'class' => 'active'
                ],
            ],
            'translation'=>new ProductsCategoryTranslation()
        ];
        return view('Products::admin.category.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('products_manage_others');
        $row = ProductsCategory::find($id);

        $translation = $row->translateOrOrigin($request->query('lang'));

        if (empty($row)) {
            return redirect(route('products.admin.category.index'));
        }
        $data = [
            'row'     => $row,
            'translation'     => $translation,
            'parents' => ProductsCategory::get()->toTree(),
            'enable_multi_lang'=>true
        ];
        return view('Products::admin.category.detail', $data);
    }

    public function store(Request $request, $id){
        $this->checkPermission('products_manage_others');

        if($id>0){
            $row = ProductsCategory::find($id);
            if (empty($row)) {
                return redirect(route('products.admin.category.index'));
            }
        }else{
            $row = new ProductsCategory();
            $row->status = "publish";
        }
        $row->fill($request->input());
        $res = $row->saveOriginOrTranslation($request->input('lang'));

        if ($res) {
            if($id > 0 ){
                return back()->with('success',  __('Category updated') );
            }else{
                return redirect(route('products.admin.category.index'))->with('success', __('Category created') );
            }
        }
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('products_manage_others');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Please select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an Action!'));
        }
        if ($action == 'delete') {
            foreach ($ids as $id) {
                $query = ProductsCategory::where("id", $id)->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');

        if($pre_selected && $selected){
            $item = ProductsCategory::find($selected);
            if(empty($item)){
                return response()->json([
                    'text'=>''
                ]);
            }else{
                return response()->json([
                    'text'=>$item->name
                ]);
            }
        }
        $q = $request->query('q');
        $query = ProductsCategory::select('id', 'name as text')->where("status","publish");
        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }
}
