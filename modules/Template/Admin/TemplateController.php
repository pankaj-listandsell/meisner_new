<?php
namespace Modules\Template\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\AdminController;
use Modules\Page\Models\Page;
use Modules\Template\Models\Template;
use Modules\Template\Models\TemplateTranslation;

class TemplateController extends AdminController
{
    /**
     * @var Template
     */
    protected $templateClass;
    protected $templateTranslationClass;
    public function __construct()
    {
        parent::__construct();
        $this->templateClass = Template::class;
        $this->templateTranslationClass = TemplateTranslation::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('template_view');
        $this->setActiveMenu(route('template.admin.index'));
        $query = $this->templateClass::query() ;
        $query->orderBy('id', 'desc');
        if (!empty($tour_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $tour_name . '%');
            $query->orderBy('title', 'asc');
        }
        $data = [
            'rows'       => $query->paginate(20),
            'page_title' => __('Template Management')
        ];
        return view('Template::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->setActiveMenu(route('template.admin.index'));
        $this->checkPermission('template_create');
        $row = new $this->templateClass();
        $data = [
            'row'         => $row,
            'breadcrumbs' => [
                [
                    'name' => __('Templates'),
                    'url'  => route('template.admin.index')
                ],
                [
                    'name'  => __('Create new template'),
                    'class' => 'active'
                ],
            ],
            'page_title'  => __('Create new Template'),
            'translation'=>new $this->templateTranslationClass()
        ];
        return view('Template::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {

        $this->checkPermission('template_update');
        $this->setActiveMenu(route('template.admin.index'));
        $row = $this->templateClass::find($id);
        if (empty($row)) {
            return redirect(route('template.admin.index'));
        }
        $translation = $row->translateOrOrigin($request->query('lang'));
        $data = [
            'row'         => $row,
            'breadcrumbs' => [
                [
                    'name' => __('Templates'),
                    'url'  => route('template.admin.index')
                ],
                [
                    'name'  => __('Edit Template: :title', ['title' => $row->title]),
                    'class' => 'active'
                ],
            ],
            'page_title'  => __('Edit Template: :title', ['title' => $row->title]),
            'translation'=>$translation,
            'enable_multi_lang'=>true
        ];
        return view('Template::admin.detail', $data);
    }

    public function clone(Request $request, $id)
    {
        $this->checkPermission('template_update');
        $this->setActiveMenu(route('template.admin.index'));
        $row = $this->templateClass::find($id);
        if (empty($row)) {
            return redirect(route('template.admin.index'));
        }
        $new = $row->replicate();
        $new->title.='  copy';
        $new->save();

        foreach(TemplateTranslation::query()->where('origin_id',$row->id)->get() as $tran){
            $a = $tran->replicate();
            $a->origin_id = $new->id;
            $a->save();
        }

        return back()->with('success',__('Template clone success'));
    }

    public function getBlocks()
    {
        $template = new $this->templateClass();
        $blocks = [];
        if(!empty($items = $template->getBlocks())){
            $blocks['all_block']['name'] = __("All Blocks");
            $blocks['all_block']['open'] = false;
            foreach ($items as $item){
                if(!empty($item['category'])){
                    $blocks[ $item['category'] ]['items'][] = $item;
                    $blocks[ $item['category'] ]['name'] = $item['category'];
                    $blocks[ $item['category'] ]['open'] = false;
                }
                $blocks['all_block']['items'][] = $item;
            }
            asort($blocks );
        }
        return $this->sendSuccess(['data' => $blocks]);
    }

    public function store(Request $request)
    {
        if(is_demo_mode()){
            return $this->sendError("DEMO MODE: Can not edit template");
        }
        $request->validate([
            'content' => 'required',
            'title'   => 'required|max:255'
        ]);
        if ($request->input('id')) {
            $this->checkPermission('template_update');
            $template = $this->templateClass::find($request->input('id'));
        } else {
            $this->checkPermission('template_create');
            $template = new $this->templateClass();
        }
        if (empty($template))
            return $this->sendError('Template not found');
        $template->content = $request->input('content');
        $template->title = $request->input('title');

        $template->saveOriginOrTranslation($request->input('lang'));

        return $this->sendSuccess([
            'url' => $request->input('id') ? '' : route('template.admin.edit',['id'=>$template->id])
        ], __('Your template has been saved'));
    }

    public function bulkEdit(Request $request)
    {
        if(is_demo_mode()){
            return redirect()->back()->with('danger',__("DEMO MODE: Disable update"));
        }
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        switch ($action){
            case "delete":
                foreach ($ids as $id) {
                    $query = $this->templateClass::where("id", $id);
                    $this->checkPermission('template_delete');
                    $query->first();
                    if(!empty($query)){
                        $query->delete();
                    }
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->templateClass::where("id", $id);
                    $this->checkPermission('template_update');
                    $query->update(['status' => $action]);
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }
    }
    public function exportTemplate(Request $request ,$id){

	    \Debugbar::disable();
    	$template = $this->templateClass::find($id);
    	if(empty($template)){
		    return redirect()->back()->with('warning', __('Template not found!'));
	    }
    	$template->load('translations');
	    $fileName = Str::slug($template->title,'_').'_template.json';
	    $path ='/templates/';
	    $fullPath = $path.$fileName;
		$json = $template->toJson();
	    $headers = array('Content-type'=> 'application/json');
	    if(Storage::disk('uploads')->put($fullPath,$json)){
			$file = Storage::disk('uploads')->path($fullPath);
			return response()->download($file,$fileName,$headers);
		}else{
			return redirect()->back()->with('warning',__('Template can\'t export. Please try again'));
		}
    }
    public function importTemplate(Request $request){
    	if($request->isMethod('post')){
    		if(!empty($request->file('file'))){
				$file = $request->file('file');
				if($file->getClientMimeType()=='application/json'){
					try{
						$content = json_decode($file->get(),true);
						$dataInput = Arr::except($content, ['id','_id']);
						$template = new Template();
						$template->fill($dataInput);
						if($template->save()){
							if(!empty($dataInput['translations'])){
								foreach ($dataInput['translations'] as $translation){
									if(!empty($translation['origin_id'])){
										unset($translation['origin_id']);
									}
									if(!empty($translation['id'])){
										unset($translation['id']);
									}
									$templateTrans = new TemplateTranslation();
									$templateTrans->fill($translation);
									if(!empty($translation['locale'])){
										$templateTrans->locale = $translation['locale'];
									}
									$templateTrans->origin_id = $template->id;
									$templateTrans->save();
									$template->translations()->save($templateTrans);
								}
							}
							return redirect()->to(route("template.admin.index"))->with('success',__('Import template '.@$dataInput['title'].' success!'));
						}
					}catch (\Exception $exception){
						return redirect()->back()->with('warning',__($exception->getMessage()));

					}
				}else{
					return redirect()->back()->with('warning',__('Only support json file'));
				}
		    }
	    }
		return view('Template::admin.import');
    }

    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = Template::query()->select('id', 'title as text');
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }

    public function city_search(Request $request)
    {
        $query = $request->input('query');
        $cities = Page::where('is_city_page',1)->where('status','publish')->where('title', 'LIKE', "%{$query}%")->get();
        return response()->json($cities);
    }

}
