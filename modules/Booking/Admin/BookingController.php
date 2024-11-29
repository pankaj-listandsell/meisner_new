<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/5/2019
 * Time: 11:31 AM
 */
namespace Modules\Booking\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Booking\Models\Booking;

class BookingController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('booking.admin.index'));
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('booking_manage');

        $s = $request->query('s');

        $query = Booking::query();  // Initialize a query on the Booking model

        if ($s) {
            $query->where(function ($query) use ($s) {
                 $query->where(DB::raw('CONCAT(contact_first_name," ", contact_last_name)'), 'LIKE', '%' . $s . '%')
                    ->orWhere('contact_email', 'LIKE', '%' . $s . '%')
                    ->orWhere('contact_telephone_no', 'LIKE', '%' . $s . '%');
            });
        }

        $data = [
            'rows'        => $query->paginate(20),  // Execute the query with pagination
            'breadcrumbs' => [
                [
                    'name' => __('Booking Submissions'),
                    'url'  => route('booking.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];

        return view('Booking::admin.index', $data);
    }


    public function modalDetailAjax(Request $request): \Illuminate\Http\JsonResponse
    {
        $booking = Booking::find($request->get('booking_id'));

        if (!$booking) {
            return response()->json('');
        }

        $content = view('Booking::admin.booking-detail', compact('booking'))->render();

        return response()->json($content);
    }

    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = Booking::select('id', 'title as text');
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
        $this->checkPermission('booking_manage');

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
                $query = Booking::where("id", $id)->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = Booking::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }
}
