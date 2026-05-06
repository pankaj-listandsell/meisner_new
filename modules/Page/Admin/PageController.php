<?php
namespace Modules\Page\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Page\Models\Page;
use Modules\Page\Models\PageTranslation;
use Modules\Template\Models\Template;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Models\Menu;
use Modules\Core\Models\SEO;
use Modules\Page\Exports\PageSeoExport;
use Modules\Page\Imports\PageSeo;
use Modules\Page\Imports\PageSeoImport;


class PageController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('page.admin.index'));
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('page_view');
        $page_name = $request->query('page_name');
        $sort_by = $request->get('sort_by');
        $order = $request->get('order', 'desc');
        if (is_default_lang()) {
            $datapage = Page::where('title', 'LIKE', '%' . $page_name . '%');

            if ($sort_by == 'date') {
                $datapage->orderBy('updated_at', $order);
            } else {
                $datapage->orderBy('title', 'asc');
            }
        } else {
            $datapage = Page::select(
                'core_pages.*',
                DB::raw("IF(core_page_translations.title IS NULL or core_page_translations.title = '', core_pages.title, core_page_translations.title) as title")
            )
            ->leftJoin('core_page_translations', 'core_pages.id', 'core_page_translations.origin_id')
            ->where('core_page_translations.title', 'LIKE', '%' . $page_name . '%');

            if ($sort_by == 'date') {
                $datapage->orderBy('core_pages.updated_at', $order);
            } else {
                $datapage->orderBy('core_page_translations.title', 'asc');
            }
        }

        $data = [
            'rows'        => $datapage->paginate(20),
            'page_title'=>__("Page Management"),
            'breadcrumbs' => [
                [
                    'name' => __('Pages'),
                    'url'  => route('page.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Page::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('page_create');
        $row = new Page();
        $row->fill([
            'status' => 'publish',
        ]);

        $data = [
            'row'         => $row,
            'translation'=>new PageTranslation(),
            'templates'     => $this->getTemplates(),
            'has_template'  => 0,
            'breadcrumbs' => [
                [
                    'name' => __('Pages'),
                    'url'  => route('page.admin.index')
                ],
                [
                    'name'  => __('Add Page'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Page::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('page_update');
        $row = Page::find($id);

        if (empty($row)) {
            return redirect(route('page.admin.index'));
        }

        $translation = $row->translateOrOrigin($request->query('lang'));

        $data = [
            'translation'   => $translation,
            'row'           => $row,
            'templates'     => $this->getTemplates(),
            'has_template'  => Template::where('id', $row->template_id)->count(),
            'breadcrumbs'   => [
                [
                    'name' => __('Pages'),
                    'url'  => route('page.admin.index')
                ],
                [
                    'name'  => __('Edit Page'),
                    'class' => 'active'
                ],
            ],
            'enable_multi_lang'=>true
        ];
        return view('Page::admin.detail', $data);
    }

    public function getTemplates()
    {
        $new_templates = [];
        $templates = Template::orderBy('id', 'desc')->limit(100)->get();
        foreach ($templates as $template) {
            $template->content = json_decode($template->content);
            $new_templates[] = $template;
        }
        return $new_templates;
    }

    public function store(Request $request, $id){

        if(is_demo_mode()){
            return redirect()->back()->with('danger',__("DEMO MODE: Disable update"));
        }
        if($id>0){
            $this->checkPermission('page_update');
            $row = Page::find($id);
            if (empty($row)) {
                return redirect(route('page.admin.index'));
            }
        }else{
            $this->checkPermission('page_create');
            $row = new Page();
        }

        $request->merge(['content' => $request->get('content'), 'slug' => Str::slug($request->get('slug'))]);

        $row->fill($request->input());

        if (is_current_lang_default_lang()) {
            $row->slug = $request->input('slug');
        }

        $row->saveOriginOrTranslation($request->query('lang'),true);

        if($id > 0 ){
            return back()->with('success',  __('Page updated') );
        }else{
            return redirect()->route('page.admin.edit',['id'=>$row->id])->with('success', $id > 0 ?  __('Page updated') : __('Page created'));
        }
    }

    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = Page::select('id', 'title as text');
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }

    public function bulkEdit(Request $request)
    {
        if(is_demo_mode()){
            return redirect()->back()->with('danger',__("DEMO MODE: Disable update"));
        }
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids)) {
            return redirect()->back()->with('error', __('Please select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('No Action is selected!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = Page::where("id", $id);
                if (!$this->hasPermission('page_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('page_delete');
                }
                $query->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = Page::where("id", $id);
                if (!$this->hasPermission('page_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('page_update');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }


    /**
     * Export CSV
     *
     * @return BinaryFileResponse
     */
    public function exportCsv(): BinaryFileResponse
    {
        return Excel::download(new PageSeoExport(), 'page_seo.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    /**
     * Import CSV
     *
     * @param Request $request
     * @return RedirectResponse|void
     */
    public function importCsv(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:csv']);

        $pages = Excel::toArray(new PageSeoImport(), request()->file('file'));

        if ( !$pages ) {
            return redirect()->back()->with('error',  __('Failed to import seo data'));
        }
        if ( !isset($pages[0]) ) {
            return redirect()->back()->with('error',  __('Failed to import seo data'));
        }
        $pages = $pages[0];
        $languageSlugs = get_language_codes();

        $dbPages = [];
        foreach ($pages as $page) {
            if (isset($page[0]) && ((int) $page[0]) != 0 && isset($page[1]) && in_array($page[1], $languageSlugs)) {
                $dbPages[] = new PageSeo((int) $page[0], $page[1], $page[2] ?? '', $page[4] ?? '', $page[5] ?? '');
            }
        }

        foreach ($dbPages as $dbPage) {
            $needUpdate = false;
            $data = [];
            if ($dbPage->seoTitle != '') {
                $needUpdate = true;
                $data['seo_title'] = $dbPage->seoTitle;
            }
            if ($dbPage->seoDescription != '') {
                $needUpdate = true;
                $data['seo_desc'] = $dbPage->seoDescription;
            }
            if ($needUpdate) {
                SEO::where('object_id', $dbPage->id)
                    ->where('object_model', $dbPage->type == PageSeo::PAGE_TYPE ? 'page' : 'page_translation_'.$dbPage->locale)
                    ->update($data);
            }
        }

        return redirect()->back()->with('success',  __('Page SEO updated'));
    }
}
