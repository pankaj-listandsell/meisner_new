<?php
namespace Modules\Products\Models;

use App\BaseModel;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;

class Products extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_products';
    protected $fillable = [
        'title',
        'content',
        'price',
        'gjs_data',
        'status',
        'cat_id',
        'image_id'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'title';
    protected $seo_type = 'products';

    protected $sitemap_type = 'page';

    /*public function getDetailUrlAttribute()
    {
        return url('products-' . $this->slug);
    }*/

    public function geCategorylink()
    {
        return route('products.admin.category.index',['slug'=>$this->slug]);
    }

    public function cat()
    {
        return $this->belongsTo(ProductsCategory::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'create_user', 'id');
    }

    public static function getAll()
    {
        return self::with('cat')->get();
    }

    /*public function getDetailUrl($locale = false)
    {
        return url(config('products.products_frontend_route_prefix')."/".$this->slug);
    }*/

    public function getCategory()
    {
        $catename = $this->belongsTo("Modules\Products\Models\ProductsCategory", "cat_id", "id");
        return $catename;
    }



    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'title as name');
        if (strlen($q)) {

            $query->where('title', 'like', "%" . $q . "%");
        }
        $a = $query->orderBy('id', 'desc')->limit(10)->get();
        return $a;
    }



    static public function getSeoMetaForPageList()
    {
        $meta['seo_title'] = __("Products"); //setting_item_with_lang("products_page_list_seo_title", false,null) ?? setting_item_with_lang("products_page_list_title",false, null) ?? __("Blogs")
        $meta['seo_desc'] = setting_item_with_lang("products_page_list_seo_desc");
        $meta['seo_image'] = setting_item("nproducts_page_list_seo_image", null) ?? setting_item("products_page_list_banner", null);
        $meta['seo_share'] = setting_item_with_lang("products_page_list_seo_share");
        $meta['full_url'] = url()->current();
        return $meta;
    }

    public function getEditUrl()
    {
        $lang = $this->lang ?? setting_item("site_locale");
        return route('products.admin.edit',['id'=>$this->id , "lang"=> $lang]);
    }

    public function dataForApi($forSingle = false){
        $translation = $this->translateOrOrigin(app()->getLocale());
        $data = [
            'id'=>$this->id,
            'slug'=>$this->slug,
            'title'=>$translation->title,
            'content'=>$translation->content,
            'image_id'=>$this->image_id,
            'image_url'=>get_file_url($this->image_id,'full'),
            'category'=>ProductsCategory::selectRaw("id,name,slug")->find($this->cat_id) ?? null,
            'created_at'=>display_date($this->created_at),
            'author'=>[
                'display_name'=>$this->getAuthor->getDisplayName(),
                'avatar_url'=>$this->getAuthor->getAvatarUrl()
            ],
            'url'=>$this->getDetailUrl()
        ];
        return $data;
    }
}
