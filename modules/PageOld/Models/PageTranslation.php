<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/16/2019
 * Time: 2:05 PM
 */
namespace Modules\Page\Models;

use App\BaseModel;
use Dotlogics\Grapesjs\App\Contracts\Editable;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;

class PageTranslation extends BaseModel implements Editable
{
    use EditableTrait;

    protected $table = 'core_page_translations';
    protected $fillable = ['id', 'slug', 'slug_affix', 'title', 'content', 'short_desc', 'gjs_data'];
    protected $seo_type = 'page_translation';

    public function getDetailUrl($locale = false)
    {
        return url($this->locale.'/'.$this->slug.($this->slug_affix ? '/'.$this->slug_affix : ''));
            //route('page.lang.detail', ['slug'=>$this->slug, 'branch' => $this->slug_affix]);
    }

    public function getContentJsonAttribute()
    {
        $json = json_decode($this->content, true);
        filterContentJson($json);
        return $json;
    }

    public function getGjsDataAttribute($value): array
    {
        $data = json_decode($value, true);
        return is_string($data) ? json_decode($data, true) : (is_array($data) ? $data : []);
    }

    public function getStoreUrlAttribute(): string
    {
        return route('page.admin.store_ajax', ['id' => request()->route('id'), 'lang' => get_current_lang()]);
    }


    public function getProcessedContent()
    {
        $blocks = getAllBlocks();
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

}
