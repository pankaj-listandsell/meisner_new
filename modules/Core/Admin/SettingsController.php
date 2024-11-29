<?php
namespace Modules\Core\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\AdminController;
use Modules\Core\Models\Settings;
use Illuminate\Support\Facades\Cache;
use Modules\Core\SettingClass;

class SettingsController extends AdminController
{
    protected $groups = [];

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('core.admin.settings.index',['group'=>"general"]));
    }

    public function index($group)
    {
        if(empty($this->groups)){
            $this->setGroups();
        }

        $this->checkPermission('setting_update');
        $settingsGroupKeys = array_keys($this->groups);
        if (empty($group) or !in_array($group, $settingsGroupKeys)) {
            $group = $settingsGroupKeys[0];
        }

        $group_data = $this->groups[$group];
        $breadcrumbs = [
           [ 'name'=>$group_data['name'] ?? $group_data['title'] ?? $group]
        ];

        if(!empty($group_data['active_menu'])){
            $this->setActiveMenu($group_data['active_menu']);
        }

        if(!empty($group_data['breadcrumbs'])){
            $breadcrumbs = $group_data['breadcrumbs'];
        }

        $data = [
            'current_group' => $group,
            'groups'        => $this->groups,
            'settings'      => Settings::getSettings($group),
            'breadcrumbs'   => $breadcrumbs,
            'page_title'    => $this->groups[$group]['name'] ?? $this->groups[$group]['title'] ?? $group,
            'group'         => $this->groups[$group],
            'enable_multi_lang'=>true
        ];
        return view('Core::admin.settings.index', $data);
    }

    public function store(Request $request, $group)
    {

        $this->checkPermission('setting_update');

        $settings = SettingClass::getSettingPages();

        if (!isset($settings[$group]) && $settings[$group]['keys']) {
            return redirect()->back()->with('error', __('Invalid Request'));
        }
        $keys = $settings[$group]['keys'];
        $htmlKeys = $settings[$group]['html_keys'] ?? [];

        $lang = $request->input('lang');
        if(is_default_lang($lang)) $lang = false;

        if (!empty($request->input())) {
            if (!empty($keys)) {

                foreach ($request->all() as $requestKey => $requestValue) {

                    if (!in_array($requestKey, $keys)) {
                        continue;
                    }

                    $setting_key = $requestKey.($lang ? '_'.$lang : '');
                    $val = $requestValue ?? '';

                    if (is_array($val)) {
                        $val = json_encode($val);
                    }
                    if (in_array($requestKey, $htmlKeys)) {
                        $val = clean($val);
                    }

                    $this->updateSettingItem($setting_key, $val);

                }

            }

            Settings::reset();
            //return redirect()->back()->with('success', __('Settings Saved'));
        }

        return redirect()->back()->with('success', __('Settings Saved'));
    }


    public function updateSettingItem($key, $value)
    {
        $settings = Settings::where('name', $key)->get();
        $totalSetting = $settings->count();

        $update = [
            'name' => $key,
            'val' => (is_array($value) or is_object($value)) ? json_encode($value) : $value,
        ];

        if (!empty($group)) {
            $update[] = ['group' => $group];
        }

        if($totalSetting == 0){
            $s = new Settings();
            $s->fill($update);
            $s->save();
        } else {
            if ($totalSetting >= 2) {
                $settingIds = $settings->pluck('id')->toArray();
                Settings::where('id', array_slice($settingIds, 1))->delete();
            }
            Settings::where('name', $key)->update($update);
        }

        Cache::forget('setting_' . $key);
    }


    protected function setGroups(){

        $all = Settings::getSettingPages();

        $res = [];

        if(!empty($all))
        {
            foreach ($all as $item){
                $res[$item['id']] = $item;
            }
        }
        $this->groups = $res;
    }


}
