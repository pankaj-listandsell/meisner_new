<?php
namespace Modules\Core\Models;

use App\BaseModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Modules\Core\SettingClass;
use Modules\Language\Models\Language;
use MongoDB\Driver\Session;

class Settings extends BaseModel
{
    use HasEvents;

    const SETTING_KEY = 'core_settings';

    protected $table = 'core_settings';
    protected $fillable=['name','group','val'];

    public static function getSettings($group = '',$locale = '')
    {
        if ($group) {
            static::where('group', $group);
        }
        $all = static::groupBy('name')->get();
        $res = [];

        foreach ($all as $row) {
            $res[$row->name] = $row->val;
        }
        return $res;
    }

    public static function item($item, $default = false)
    {
        $value = Cache::rememberForever('setting_' . $item, function () use ($item ,$default) {

            $settings = self::getAllSettings();

            $value = null;

            foreach ($settings as $settingKey => $settingValue) {
                if ($settingKey == $item) {
                    $value = $settingValue;
                }
            }

            return $value;

            /*$val = Settings::where('name', $item)->first();
            return $val?$val['val']:'';*/
        });

        return (empty($value) and strlen($value ?? '')===0)?$default:$value;
    }

    public static function store($key,$data){

        $check = Settings::where('name', $key)->first();

        if($check){
            $check->val = $data;
            $check->save();
        }else{
            $check = new self();
            $check->val = $data;
            $check->name = $key;
            $check->save();
        }

        Cache::forget('setting_' . $key);
    }

    public static function getSettingPages($forMenu = false){
        $siteSettings = SettingClass::getSettingPages();

        $allSettings = [
            'general'=> $siteSettings['general'],
        ];

        // Modules
        $custom_modules = \Modules\ServiceProvider::getActivatedModules();

        if(!empty($custom_modules)){
            foreach($custom_modules as $module=>$moduleData){
                $moduleClass = str_replace('ModuleProvider','SettingClass',$moduleData['class']);

                if(class_exists($moduleClass))
                {
                    $blockConfig = call_user_func([$moduleClass,'getSettingPages']);

                    if(!empty($blockConfig)){
                        foreach ($blockConfig as $k=>$v){
                            if (isset($v['enabled']) && $v['enabled'])
                                $allSettings[$v['id']] = $v;
                        }
                    }
                }
            }
        }

        //Custom
        $custom_modules = \Custom\ServiceProvider::getModules();
        if(!empty($custom_modules)){
            foreach($custom_modules as $module){
                $moduleClass = "\\Custom\\".ucfirst($module)."\\SettingClass";
                if(class_exists($moduleClass))
                {
                    $blockConfig = call_user_func([$moduleClass,'getSettingPages']);
                    if(!empty($blockConfig)){
                        foreach ($blockConfig as $k=>$v){
                            $allSettings[$v['id']] = $v;
                        }
                    }
                }
            }
        }

        //Plugins
        $plugins_modules = \Plugins\ServiceProvider::getModules();
        if(!empty($plugins_modules)){
            foreach($plugins_modules as $module){
                $moduleClass = "\\Plugins\\".ucfirst($module)."\\SettingClass";
                if(class_exists($moduleClass))
                {
                    $blockConfig = call_user_func([$moduleClass,'getSettingPages']);
                    if(!empty($blockConfig)){
                        foreach ($blockConfig as $k=>$v){
                            $allSettings[$v['id']] = $v;
                        }
                    }
                }
            }
        }

        //@todo Sort items by Position
        $allSettings = array_values(\Illuminate\Support\Arr::sort($allSettings, function ($value) {
            return $value['position'] ?? 0;
        }));

        if(!empty($allSettings)){
            foreach ($allSettings as $k=>$item)
            {
                if(!empty($item['hide_in_settings_menu']) and $forMenu){
                    unset($allSettings[$k]);
                    continue;
                }
                $item['url'] = route('core.admin.settings.index',['group'=>$item['id']]);
                $item['name'] = $item['title'] ?? $item['id'];
                $item['icon'] = $item['icon'] ?? '';

                $allSettings[$k] = $item;
            }
        }
        return $allSettings;
    }


    public static function init()
    {
        return Cache::rememberForever(self::SETTING_KEY, function() {
            $settings = Settings::select('name', 'val')->get();
            $newSettings = [];
            foreach ($settings as $setting) {
                $newSettings[$setting->name] = $setting->val;
            }
            return $newSettings;
        });
    }

    public static function reset()
    {
        Cache::forget(self::SETTING_KEY);
        self::init();
    }

    public static function getAllSettings() : array
    {
        $settings = Cache::get(self::SETTING_KEY);
        return $settings ? (array) $settings : self::init();
    }

    public static function clearCustomCssCache(){
        $langs = Language::getActive();
        if(!empty($langs)){
            foreach ($langs as $lang)
            {
                Cache::forget("custom_css_". config('bc.active_theme').'_' .$lang->locale);
            }
        }
    }
}
