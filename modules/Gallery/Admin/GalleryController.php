<?php
/**
 * Created
 * User: saxina@listandsell.de
 * Date: 03/10/2022
 * Time: 3:27 PM
 */
namespace Modules\Gallery\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Gallery\Models\Gallery;
use Modules\Gallery\Models\GalleryTranslation;
use App\Notifications\AdminChannelServices;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\FrontendController;
use Modules\Core\Models\Attributes;
use Modules\Gallery\Requests\SortGalleryRequest;

class GalleryController extends AdminController
{
    protected $gallery;
    protected $gallery_translation;

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('gallery.admin.index'));
        $this->gallery = Gallery::class;
        $this->gallery_translation = GalleryTranslation::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('gallery_view');
        $query = $this->gallery::query();
        $query->orderBy('id', 'desc');
        if (!empty($s = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $s . '%');
            $query->orderBy('title', 'asc');
        }
        $data = [
            'rows'              => $query->paginate(20),
            'breadcrumbs'       => [
                [
                    'name' => __('Gallery'),
                    'url'  => route('gallery.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'        => __("Gallery Management")
        ];
        return view('Gallery::admin.index', $data);
    }

    public function recovery(Request $request)
    {
        $this->checkPermission('gallery_view');
        $query = $this->gallery::onlyTrashed();
        $query->orderBy('id', 'desc');
        if (!empty($s = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $s . '%');
            $query->orderBy('title', 'asc');
        }

        $data = [
            'rows'              => $query->paginate(20),
            'recovery'          => 1,
            'breadcrumbs'       => [
                [
                    'name' => __('Gallery'),
                    'url'  => route('gallery.admin.index')
                ],
                [
                    'name'  => __('Recovery'),
                    'class' => 'active'
                ],
            ],
            'page_title'        => __("Recovery Gallery Management")
        ];
        return view('Gallery::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('gallery_create');
        $row = new $this->gallery();
        $row->fill([
            'status'    => 'publish'
        ]);
        $data = [
            'row'           => $row,
            'translation'   => new $this->gallery_translation(),
            'breadcrumbs'   => [
                [
                    'name'  => __('Gallery'),
                    'url'   => route('gallery.admin.index')
                ],
                [
                    'name'  => __('Add Gallery'),
                    'class' => 'active'
                ]
                ],
                'page_title'   => __("Add new Gallery")
            ];

        return view('Gallery::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('gallery_update');
        $row = $this->gallery::find($id);
        if (empty($row)) {
            return redirect(route('gallery.admin.index'));
        }
        $translation = $row->translateOrOrigin($request->query('lang'));
        $data = [
            'row'               => $row,
            'translation'       => $translation,
            'enable_multi_lang' => true,
            'breadcrumbs'       => [
                [
                    'name' => __('Gallery'),
                    'url'  => route('gallery.admin.index')
                ],
                [
                    'name'  => __('Edit Gallery'),
                    'class' => 'active'
                ],
            ],
            'page_title'        => __("Edit: :name", ['name' => $row->title])
        ];
        return view('Gallery::admin.detail', $data);
    }

    public function store(Request $request, $id)
    {
        if ($id > 0) {
            $this->checkPermission('gallery_update');
            $row = $this->gallery::find($id);
            if (empty($row)) {
                return redirect(route('gallery.admin.index'));
            }
        } else {
            $this->checkPermission('gallery_create');
            $row = new $this->gallery();
            $row->status = "publish";
        }
        $dataKeys = [
            'title',
            'type',
            'gallery',
            'status'
        ];

        $row->fillByAttr($dataKeys, $request->input());
        $res = $row->saveOriginOrTranslation($request->input('lang'), true);
        if ($res) {

            if ($id > 0) {
                return back()->with('success', __('Gallery updated'));
            } else {
                return redirect(route('gallery.admin.index', $row->id))->with('success', __('Gallery created'));
            }
        }
    }

    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        switch ($action) {
            case "delete":
                foreach ($ids as $id) {
                    $query = $this->gallery::where("id", $id);
                    $this->checkPermission('gallery_delete');
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->delete();
                    }
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            case "permanently_delete":
                foreach ($ids as $id) {
                    $query = $this->gallery::where("id", $id);
                    $this->checkPermission('gallery_delete');
                    $row = $query->withTrashed()->first();
                    if ($row) {
                        $row->forceDelete();
                    }
                }
                return redirect()->back()->with('success', __('Permanently delete success!'));
                break;
            case "recovery":
                foreach ($ids as $id) {
                    $query = $this->gallery::withTrashed()->where("id", $id);
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->restore();
                    }
                }
                return redirect()->back()->with('success', __('Recovery success!'));
                break;
            case "clone":
                $this->checkPermission('gallery_create');
                foreach ($ids as $id) {
                    (new $this->gallery())->saveCloneByID($id);
                }
                return redirect()->back()->with('success', __('Clone success!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->gallery::where("id", $id);
                    $this->checkPermission('gallery_update');
                    $row = $query->first();
                    $row->status = $action;
                    $row->save();
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }
    }

    public function sortImages(SortGalleryRequest $request)
    {
        $imagesInString = implode(',', $request->get('image_ids'));
        Gallery::where('id', $request->get('gallery_id'))->update(['gallery' => $imagesInString]);

        return json_success_response('Gallery sorted successfully');
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');
        $type = $request->query('type');
        if ($pre_selected && $selected) {
            if (is_array($selected)) {
                $items = $this->gallery::select('id', 'title as text')->whereIn('id', $selected)->take(50)->get();
                return $this->sendSuccess([
                    'items' => $items
                ]);
            } else {
                $item = $this->gallery::find($selected);
            }
            if (empty($item)) {
                return $this->sendSuccess([
                    'text' => ''
                ]);
            } else {
                return $this->sendSuccess([
                    'text' => $item->name
                ]);
            }
        }
        $q = $request->query('q');
        $query = $this->gallery::select('id', 'title as text')->where([
            "status"    => "publish",
            "type"      => $type
        ]);
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return $this->sendSuccess([
            'results' => $res
        ]);
    }

}
