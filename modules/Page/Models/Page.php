<?php
namespace Modules\Page\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Modules\Theme\ThemeManager;

class Page extends BaseModel
{
    use SoftDeletes;

    protected $table = 'core_pages';
    protected $fillable = [
        'title',
        'slug_affix',
        'content',
        'short_desc',
        'image_id',
        'template_id',
        'header_style',
        'custom_logo',
        'is_city_page',
        'status',
        'has_shortcode'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'title';

    protected $seo_type = 'page';

    protected $sitemap_type = 'page';

    protected static $_blocks = [];

    public function getDetailUrl($locale = false)
    {
        return route('page.detail',['slug'=>$this->slug, 'branch'=>$this->slug_affix]);
    }

    public static function getModelName()
    {
        return __("Page");
    }

    public static function getAsMenuItem($id)
    {
        return parent::select('id', 'title as name')->find($id);
    }

    public static function searchForMenu($q = false)
    {
        $lang = get_current_lang();

        $query = parse_url(request()->headers->get('referer'), PHP_URL_QUERY);
        parse_str($query, $params);
        if (isset($params['lang'])) {
            $lang = $params['lang'];
        }

        if (get_current_lang($lang) == get_default_lang()) {
            $query = static::select('id', 'title as name');
            if (strlen($q)) {
                $query->where('title', 'like', "%" . $q . "%");
            }
            $a = $query->orderBy('title')->get();
        } else {
            $query = Page::select('core_pages.id', 'core_page_translations.title as name',
                DB::raw("IF(core_page_translations.title IS NULL or core_page_translations.title = '', core_pages.title, core_page_translations.title) as title"),
            )
            ->leftJoin('core_page_translations', 'core_pages.id', 'core_page_translations.origin_id')
            ->where('core_page_translations.locale', $lang);

            if (strlen($q)) {
                $query->where('core_page_translations.title', 'like', "%" . $q . "%");
            }
            $a = $query->orderBy('core_page_translations.title')->get();
        }

        return $a;
    }

    public function getEditUrlAttribute()
    {
        return url(route('page.admin.edit',['id'=>$this->id]));
    }

    public function template()
    {
        return $this->hasOne("\\Modules\\Template\\Models\\Template", 'id', 'template_id');
    }

    public function getAllBlocks(){
        if(!empty(static::$_blocks)){
            return static::$_blocks;
        }

        $blocks = config('template.blocks');
        // Modules
        $custom_modules = \Modules\ServiceProvider::getActivatedModules();

        if(!empty($custom_modules)){
            foreach($custom_modules as $module=>$moduleData){
                $moduleClass = $moduleData['class'];
                if(class_exists($moduleClass))
                {
                    $blockConfig = call_user_func([$moduleClass,'getTemplateBlocks']);
                    if(!empty($blockConfig)){
                        $blocks = array_merge($blocks,$blockConfig);
                    }
                }
            }
        }

        //Plugins
        $plugins_modules = \Plugins\ServiceProvider::getModules();
        if(!empty($plugins_modules)){
            foreach($plugins_modules as $module){
                $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
                if(class_exists($moduleClass))
                {
                    $blockConfig = call_user_func([$moduleClass,'getTemplateBlocks']);
                    if(!empty($blockConfig)){
                        $blocks = array_merge($blocks,$blockConfig);
                    }
                }
            }
        }

        //Custom
        $custom_modules = \Custom\ServiceProvider::getModules();
        if(!empty($custom_modules)){
            foreach($custom_modules as $module){
                $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
                if(class_exists($moduleClass))
                {
                    $blockConfig = call_user_func([$moduleClass,'getTemplateBlocks']);
                    if(!empty($blockConfig)){
                        $blocks = array_merge($blocks,$blockConfig);
                    }
                }
            }
        }
        $provider = ThemeManager::currentProvider();
        if(class_exists($provider)){
            $blockConfig = call_user_func([$provider,'getTemplateBlocks']);
            if(!empty($blockConfig)){
                $blocks = array_merge($blocks,$blockConfig);
            }
        }
        static::$_blocks = $blocks;
        return $blocks;
    }

    public function getProcessedContent()
    {
        $blocks = $this->getAllBlocks();
        $items = json_decode($this->content, true);
        if (empty($items))
            return '';
        $html = '';
        foreach ($items as $item) {
            if (empty($item['type']))
                continue;
            if (!array_key_exists($item['type'], $blocks) or !class_exists($blocks[$item['type']]))
                continue;
            $item['model'] = isset($item['model']) ? $item['model'] : [];
            $blockModel = new $blocks[$item['type']]();
            if (method_exists($blockModel, 'content')) {
                $html .= call_user_func([
                    $blockModel,
                    'content'
                ], $item['model']);
            }
        }
        return $html;
    }


    public function getJsonContent($content)
    {
        $json = json_decode($content, true);
        self::filterContentJson($json);
        return $json;
    }


    protected function filterContentJson(&$json)
    {
        if (!empty($json)) {
            foreach ($json as $k => &$item) {
                if (!isset($item['type'])) {
                    unset($json[$k]);
                    continue;
                }
                $block = $this->getBlockByType($item['type']);
                if (empty($block)) {
                    unset($json[$k]);
                    continue;
                }
                $item['is_container'] = $block['is_container'] ?? false;
                $item['component'] = $block['component'] ?? 'RegularBlock';
                if (isset($item['settings']))
                    unset($item['settings']);
                if (empty($item['model']))
                    $item['model'] = [];
                if (!empty($block['model'])) {
                    foreach ($block['model'] as $key => $val) {
                        if (!isset($item['model'][$key]))
                            $item['model'][$key] = $val;
                    }
                }
                if (!empty($item['children'])) {
                    $this->filterContentJson($item['children']);
                }
            }
        }
        $json = array_values((array)$json);
    }

    public function getBlocks()
    {
        $blocks = $this->getAllBlocks();

        $res = [];
        foreach ($blocks as $block => $class) {
            if (!class_exists($class))
                continue;
            $obj = new $class();
            //if(!is_subclass_of($obj,"\\Module\\Template\\Block\\BaseBlock")) continue;
            $options = $obj->getOptions();
            $options['name'] = $obj->getName();
            $options['id'] = $block;
            $options['component'] = $obj->options['component'] ?? 'RegularBlock';
            $this->parseBlockOptions($options);
            $res[] = $options;
        }
        return $res;
    }

    public function getBlockByType($type)
    {
        $all = $this->getBlocks();
        if (!empty($all)) {
            foreach ($all as $block) {
                if ($type == $block['id'])
                    return $block;
            }
        }
        return false;
    }

    protected function parseBlockOptions(&$options)
    {

        $options['model'] = [];
        if (!empty($options['settings'])) {
            foreach ($options['settings'] as &$setting) {

                $setting['model'] = $setting['id'];
                $val = $setting['std'] ?? '';
                switch ($setting['type']) {
                    default:
                        break;
                }
                if (!empty($setting['multiple'])) {
                    $val = (array)$val;
                }
                $options['model'][$setting['id']] = $val;
            }
        }
    }

    public function getProcessedContentAPI(){
        $res = [];
        $blocks = $this->getAllBlocks();
        $items = json_decode($this->content, true);
        if (empty($items)) return $res;
        foreach ($items as $item) {
            if (empty($item['type']))
                continue;
            if (!array_key_exists($item['type'], $blocks) or !class_exists($blocks[$item['type']]))
                continue;
            $item['model'] = isset($item['model']) ? $item['model'] : [];
            $blockModel = new $blocks[$item['type']]();
            if (method_exists($blockModel, 'contentAPI')) {
                $item["model"] = call_user_func([
                    $blockModel,
                    'contentAPI'
                ], $item['model']);
            }
            $res[] = $item;
        }
        return $res;
    }

}
