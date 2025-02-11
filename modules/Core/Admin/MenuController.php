<?php
namespace Modules\Core\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Modules\AdminController;
use Modules\Core\Models\Menu;
use Modules\Core\Models\MenuTranslation;
use Modules\Core\Models\Settings;
use Modules\Core\Walkers\MenuWalker;

class MenuController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('core.admin.menu.index'));
        parent::__construct();
    }

    public function index()
    {

        $this->checkPermission('menu_view');
        $data = [
            'rows'           => Menu::paginate(20),
            'locations'      => $this->getLocations(),
            "menu_locations" => (array)json_decode(setting_item('menu_locations'), true)
        ];
        return view('Core::admin.menu.index', $data);
    }

    public function getLocations()
    {
        return [
            'primary' => __("Primary"),
//            'footer'  => __("Footer"),
        ];
    }

    public function create()
    {

        $this->checkPermission('menu_create');
        $data = [
            'row'                    => new Menu(),
            'locations'              => $this->getLocations(),
            'current_menu_locations' => [],
            'breadcrumbs'            => [
                [
                    'name' => __('Menus'),
                    'url'  => route('core.admin.menu.index')
                ],
                [
                    'name'  => __('Create new menu'),
                    'class' => 'active'
                ],
            ],
            'translation'=>new MenuTranslation()
        ];
        return view('Core::admin.menu.detail', $data);
    }

    public function edit($id)
    {
        $this->checkPermission('menu_update');
        $row = Menu::find($id);
        if (empty($row)) {
            abort(404);
        }
        $setting = json_decode(setting_item('menu_locations'), true);
        $current_menu_locations = [];
        if (!empty($setting) and is_array($setting)) {
            foreach ($setting as $location => $item) {
                if ($item == $id) {
                    $current_menu_locations[] = $location;
                }
            }
        }

        $translation = $row->translateOrOrigin(request()->get('lang'));

        $data = [
            'row'                    => $row,
            'translation'            => $translation,
            'locations'              => $this->getLocations(),
            'current_menu_locations' => $current_menu_locations,
            'breadcrumbs'            => [
                [
                    'name' => __('Menus'),
                    'url'  => route('core.admin.menu.index')
                ],
                [
                    'name'  => __('Edit: ') . $row->name,
                    'class' => 'active'
                ],
            ],
            'enable_multi_lang'=>true
        ];

        return view('Core::admin.menu.detail', $data);
    }

    public function searchTypeItems(Request $request)
    {

        $class = $request->input('class');
        $q = $request->input('q');
        if (class_exists($class) and method_exists($class, 'searchForMenu')) {

            $menuItems = call_user_func([
                $class,
                'searchForMenu'
            ], $q);

            foreach ($menuItems as $k => &$menuItem) {
                $menuItem['class'] = '';
                $menuItem['target'] = '';
                $menuItem['open'] = false;
                $menuItem['item_model'] = $class;
                $menuItem['origin_name'] = $menuItem['name'];
                $menuItem['model_name'] =$class::getModelName();
            }

            return $this->sendSuccess([
                'data' => $menuItems
            ]);
        }
        return $this->sendSuccess([
            'data' => []
        ]);
    }

    public function getTypes()
    {
        $menuModels = [
            [
                'class' => \Modules\Page\Models\Page::class,
                'name'  => __("Page"),
                'items' => \Modules\Page\Models\Page::searchForMenu(),
                'position'=>10
            ],
        ];

        // Modules
        $custom_modules = \Modules\ServiceProvider::getModules();
        if(!empty($custom_modules)){
            foreach($custom_modules as $module){
                $moduleClass = "\\Modules\\".ucfirst($module)."\\ModuleProvider";
                if(class_exists($moduleClass))
                {
                    $menuConfig = call_user_func([$moduleClass,'getMenuBuilderTypes']);

                    if(!empty($menuConfig)){
                        $menuModels = array_merge($menuModels,$menuConfig);
                    }

                }

            }
        }
        // Plugins Menu
        $plugins_modules = \Plugins\ServiceProvider::getModules();
        if(!empty($plugins_modules)){
            foreach($plugins_modules as $module){
                $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
                if(class_exists($moduleClass))
                {
                    $menuConfig = call_user_func([$moduleClass,'getMenuBuilderTypes']);
                    if(!empty($menuConfig)){
                        $menuModels = array_merge($menuModels,$menuConfig);
                    }
                }
            }
        }
        // Custom Menu
        $custom_modules = \Custom\ServiceProvider::getModules();
        if(!empty($custom_modules)){
            foreach($custom_modules as $module){
                $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
                if(class_exists($moduleClass))
                {
                    $menuConfig = call_user_func([$moduleClass,'getMenuBuilderTypes']);

                    if(!empty($menuConfig)){
                        $menuModels = array_merge($menuModels,$menuConfig);
                    }

                }

            }
        }

        $menuModels = array_values(\Illuminate\Support\Arr::sort($menuModels, function ($value) {
            return $value['position'] ?? 100;
        }));
        foreach ($menuModels as $k => &$item) {
            $item['q'] = '';
            $item['open'] = !$k ? true : false;
            $item['selected'] = [];
            if (!empty($item['items'])) {
                foreach ($item['items'] as &$menuItem) {
                    $menuItem['class'] = '';
                    $menuItem['target'] = '';
                    $menuItem['open'] = false;
                    $menuItem['item_model'] = $item['class'];
                    $menuItem['origin_name'] = $item['name'];
                    $menuItem['model_name'] = $item['class']::getModelName();
                }
            }
        }
        return $this->sendSuccess(['data' => $menuModels]);
    }

    public function getItems(Request $request)
    {

        $menu = Menu::find($request->input('id'));
        if (empty($menu))
            return $this->sendError(__("Menu not found"));
        return $this->sendSuccess(['data' => json_decode($menu->items, true)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required',
            'name'  => 'required|max:255'
        ]);

        if ($request->input('id')) {
            $this->checkPermission('menu_update');
            $menu = Menu::find($request->input('id'));
        } else {

            $this->checkPermission('menu_create');
            $menu = new Menu();
        }
        if (empty($menu))
            return $this->sendError(__('Menu not found'));

        $items = json_decode($request->input('items'),true);
        $newItems = clean_by_key($items, 'name');
        $menu->items = json_encode($newItems);
        $menu->name = $request->input('name');
        $menu->slug = Str::slug($request->input('name'));
        ob_start();
        (new MenuWalker($menu))->generate($request->get('lang'));
        $html = ob_get_clean();
        $menu->content = $html;
        $request->merge(['content' => $html]);
        $menu->saveOriginOrTranslation($request->input('lang'));

        $lang = in_array($request->get('lang'), get_language_codes()) ? $request->input('lang') : get_default_lang();
        if ($menu->id == Settings::item('primary_menu_id')) {
            Cache::forget('primary_menu_'.$lang);
        }
        Cache::forget(strtolower($menu->slug).'_'.$lang);

        return $this->sendSuccess([
            'url' => $request->input('id') ? '' : route('core.admin.menu.edit',['id'=>$menu->id])
        ], __('Your menu has been saved'));
    }

    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = Menu::select('id', 'name as text');
        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }

    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }

        switch ($action) {
            case "delete":
                foreach ($ids as $id) {
                    $query = Menu::where("id", $id);
                    if (!$this->hasPermission('menu_update')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('menu_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->delete();
                    }
                }
                return redirect()->back()->with('success', __('Deleted success!'));
            break;
        }
    }
}
