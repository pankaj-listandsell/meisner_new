<?php

namespace Modules\Redirection\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Redirection\Models\Redirection;

class RedirectionController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('redirection.admin.index'));
    }

    public function index(Request $request)
    {
        $this->checkPermission('redirection_view');
        $query = Redirection::query();
        $query->orderBy('id', 'desc');
        if (!empty($s = $request->input('s'))) {
            $query->where('from_url', 'LIKE', '%' . $s . '%')
                ->orWhere('to_url', 'LIKE', '%' . $s . '%');
            $query->orderBy('from_url', 'asc');
        }
        $data = [
            'rows'              => $query->paginate(20),
            'breadcrumbs'       => [
                [
                    'name' => __('Redirections'),
                    'url'  => route('redirection.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'        => __("Redirection Management")
        ];
        return view('Redirection::admin.index', $data);
    }

    public function recovery(Request $request)
    {
        $this->checkPermission('redirection_view');
        $query = Redirection::onlyTrashed();
        $query->orderBy('id', 'desc');
        if (!empty($s = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $s . '%');
            $query->orderBy('title', 'asc');
        }

        $data = [
            'rows'              => $query->with(['author'])->paginate(20),
            'recovery'          => 1,
            'breadcrumbs'       => [
                [
                    'name' => __('Redirections'),
                    'url'  => route('redirection.admin.index')
                ],
                [
                    'name'  => __('Recovery'),
                    'class' => 'active'
                ],
            ],
            'page_title'        => __("Recovery Redirection Management")
        ];
        return view('Redirection::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('redirection_create');
        $row = new Redirection();
        $row->fill([
            'status' => 'publish'
        ]);
        $data = [
            'row'          => $row,
            'breadcrumbs'  => [
                [
                    'name' => __('Redirections'),
                    'url'  => route('redirection.admin.index')
                ],
                [
                    'name'  => __('Add Redirection'),
                    'class' => 'active'
                ],
            ],
            'page_title'   => __("Add new Redirection")
        ];
        return view('Redirection::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('redirection_update');
        $row = Redirection::find($id);
        if (empty($row)) {
            return redirect(route('redirection.admin.index'));
        }

        $data = [
            'row'               => $row,
            'enable_multi_lang' => true,
            'breadcrumbs'       => [
                [
                    'name' => __('Redirections'),
                    'url'  => route('redirection.admin.index')
                ],
                [
                    'name'  => __('Edit Redirection'),
                    'class' => 'active'
                ],
            ],
            'page_title'        => __("Edit: :name", ['name' => $row->title])
        ];
        return view('Redirection::admin.detail', $data);
    }

    public function store(Request $request, $id)
    {
        if ($id > 0) {
            $this->checkPermission('redirection_update');
            $row = Redirection::find($id);
            if (empty($row)) {
                return redirect(route('redirection.admin.index'));
            }
        } else {
            $this->checkPermission('redirection_create');
            $row = new Redirection();
        }

        $row->fill($request->input());
        $row->save();

        Redirection::reset();

        if ($id > 0) {
            return back()->with('success', __('Redirection updated'));
        } else {
            return redirect(route('redirection.admin.edit', $row->id))->with('success', __('Redirection created'));
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
                $count = 0;
                foreach ($ids as $id) {
                    $query = Redirection::where("id", $id);
                    $this->checkPermission('redirection_delete');
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->delete();
                        $count++;
                    }
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            default:
                // Change status
                $count = 0;
                foreach ($ids as $id) {
                    $query = Redirection::where("id", $id);
                    $this->checkPermission('redirection_update');
                    $row = $query->first();
                    if ($row) {
                        $row->status = $action;
                        $row->save();
                        $count++;
                    }
                }
                if ($count) {
                    Redirection::reset();
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }


    }

}
