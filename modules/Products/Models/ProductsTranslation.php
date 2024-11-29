<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/16/2019
 * Time: 2:05 PM
 */
namespace Modules\Products\Models;

use App\BaseModel;

class ProductsTranslation extends BaseModel
{
    protected $table = 'core_products_translations';
    protected $fillable = ['slug', 'title', 'content', 'gjs_data'];
    protected $seo_type = 'products_translation';
    protected $cleanFields = [
        'content'
    ];
}
