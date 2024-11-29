<?php
namespace Modules\Template\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\FrontendController;
use Modules\Page\Models\Page;
use Modules\Template\Models\Template;
use Modules\Template\Models\TemplateTranslation;

class TemplateController extends FrontendController
{

    public function city_search(Request $request)
    {
        $query = $request->input('query');
        $cities = Page::where('is_city_page',1)->where('status','publish')->where('title', 'LIKE', "%{$query}%")->get();
        return response()->json($cities);
    }

}
