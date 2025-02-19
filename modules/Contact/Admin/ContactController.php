<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/5/2019
 * Time: 11:31 AM
 */
namespace Modules\Contact\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Contact\Models\Contact;
use Modules\RequestQuote\Models\RequestQuote;

class ContactController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('contact.admin.index'));
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('contact_manage');

        $s = $request->query('s');
        $query = Contact::query(); // Initialize a query on the Contact model

        if ($s) {
            $query->where(function ($query) use ($s) {
                $query->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'LIKE', '%' . $s . '%')
                    ->orWhere('email', 'LIKE', '%' . $s . '%')
                    ->orWhere('message', 'LIKE', '%' . $s . '%');
            });
        }

        $data = [
            'rows'        => $query->paginate(20), // Execute the query with pagination
            'breadcrumbs' => [
                [
                    'name' => __('Contact Submissions'),
                    'url'  => route('contact.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];

        return view('Contact::admin.index', $data);
    }


    public function modalDetailAjax(Request $request): \Illuminate\Http\JsonResponse
    {
        $contact = Contact::find($request->get('contact_id'));

        if (!$contact) {
            return response()->json('');
        }

        $content = view('Contact::admin.contact-detail', compact('contact'))->render();

        return response()->json($content);
    }

    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = Contact::select('id', 'title as text');
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
        $this->checkPermission('contact_manage');

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
                $query = Contact::where("id", $id)->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = Contact::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }


    public function indexq(Request $request)
    {
        $this->checkPermission('requestquote_manage');

        $s = $request->query('s');

        $query = RequestQuote::query();  // Initialize a query on the Booking model

        if ($s) {
            $query->where(function ($query) use ($s) {
                 $query->where('name', 'LIKE', '%' . $s . '%')
                 ->orWhere('email','LIKE', '%' . $s . '%')
                 ->orWhere('phone','LIKE', '%' . $s . '%')
                 ->orWhere('service','LIKE', '%' . $s . '%');
            });
        }

        $data = [
            'rows'        => $query->paginate(20),  // Execute the query with pagination
            'breadcrumbs' => [
                [
                    'name' => __('Request Submissions'),
                    'url'  => route('requestquote.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];

        return view('RequestQuote::admin.index', $data);
    }


    public function modalDetailAjaxq(Request $request): \Illuminate\Http\JsonResponse
    {
        $quote = RequestQuote::find($request->get('requestquote_id'));

        if (!$quote) {
            return response()->json('');
        }

        $content = view('RequestQuote::admin.requestquote-detail', compact('quote'))->render();

        return response()->json($content);
    }



    public function bulkEditq(Request $request)
    {
        $this->checkPermission('requestquote_manage');

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
                $query = RequestQuote::where("id", $id)->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = RequestQuote::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }
}
