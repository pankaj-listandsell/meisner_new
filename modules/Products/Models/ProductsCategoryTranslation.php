<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/16/2019
 * Time: 2:05 PM
 */
namespace Modules\Products\Models;

use App\BaseModel;

class ProductsCategoryTranslation extends BaseModel
{
    protected $table = 'core_products_category_translations';
    protected $fillable = ['name', 'slug', 'content'];
    protected $seo_type = 'products_cat_translation';
    protected $cleanFields = [
        'content'
    ];
}
