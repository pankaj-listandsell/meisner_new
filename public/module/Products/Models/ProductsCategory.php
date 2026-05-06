<?php
namespace Modules\Products\Models;

use App\BaseModel;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;

class ProductsCategory extends BaseModel
{
    use SoftDeletes;
    use NodeTrait;
    protected $table = 'core_products_category';
    protected $fillable = [
        'name',
        'slug',
        'content',
        'image_id',
        'status',
        'parent_id'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';
    protected $seo_type = 'news_category';

    public static function getModelName()
    {
        return __("News Category");
    }

    public function filterbyCat($id)
    {
        $posts = Products::where('news_id', $this->id)->get();
        return $posts;
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'name');
        if (strlen($q)) {

            $query->where('name', 'like', "%" . $q . "%");
        }
        $a = $query->orderBy('id', 'desc')->limit(10)->get();
        return $a;
    }

    public function getDetailUrl($locale = false)
    {
        return route('products.admin.category.index',['slug'=>$this->slug]);
    }

    public function dataForApi(){
        $translation = $this->translateOrOrigin(app()->getLocale());
        return [
            'name'=>$translation->name,
            'id'=>$this->id,
            'url'=>$this->getDetailUrl()
        ];
    }

    public function products(){
        return $this->hasMany(Products::class,'cat_id');
    }

}
