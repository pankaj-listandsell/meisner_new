<?php
namespace Modules\Gallery\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Modules\Core\Models\SEO;
use Modules\Media\Helpers\FileHelper;

class Gallery extends BaseModel
{
    protected $table = 'bravo_gallery';

    protected $fillable     = [
        //Gallery info
        'title',
        'type',
        'status',
        'gallery'
    ];

    public static function getModelName()
    {
        return __("Gallery");
    }

    protected $galleryTranslationClass;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->galleryTranslationClass = GalleryTranslation::class;
    }

    public static function isEnable()
    {
        return setting_item('gallery_disable') == false;
    }

    public function getDetailUrl($lang = ''){
        // return route('home',['preview_popup_id'=>$this->id,'lang'=>$lang]);
    }

    public function saveCloneByID($clone_id){
        $old = parent::find($clone_id);
        if(empty($old)) return false;
        $old->title = $old->title." - Copy";
        $old->status = 'draft';

        $new = $old->replicate();
        $new->save();
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

    public function getGallery()
    {
        if (empty($this->gallery))
            return $this->gallery;
        $list_item = [];
        if ($this->image_id) {
            $list_item[] = [
                'large' => FileHelper::url($this->image_id, 'full'),
                'thumb' => FileHelper::url($this->image_id, 'thumb')
            ];
        }
        $items = explode(",", $this->gallery);
        foreach ($items as $k => $item) {
            $large = FileHelper::url($item, 'full');
            $thumb = FileHelper::url($item, 'thumb');
            if ($large && $thumb) {
                $list_item[] = [
                    'large' => $large,
                    'thumb' => $thumb
                ];
            }
        }
        return $list_item;
    }
}
