<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/5/2019
 * Time: 11:31 AM
 */
namespace Modules\BookingProduct\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Booking\Models\Booking;
use Modules\BookingProduct\Models\BookingProduct;
use Modules\BookingProduct\Models\BookingProductDetail;

class BookingController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('booking_products.admin.index'));
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('booking_product_manage');

        $s = $request->query('search');

        $query = BookingProduct::query();  // Initialize a query on the Booking model

        if ($s) {
            $query->where(function ($query) use ($s) {
                 $query->where('booking_id', 'LIKE', '%' . $s . '%')
                    ->orWhere('address', 'LIKE', '%' . $s . '%')
                    ->orWhere('date', 'LIKE', '%' . $s . '%')
                    ->orWhere('full_name', 'LIKE', '%' . $s . '%');
            });
        }

        $data = [
            'rows'        => $query->orderBy('id','DESC')->paginate(20),  // Execute the query with pagination
            'breadcrumbs' => [
                [
                    'name' => __('Booking Submissions'),
                    'url'  => route('booking_products.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];

        return view('BookingProduct::admin.index', $data);
    }

    public function view(Request $request, $id)
    {
        $this->checkPermission('booking_products_view');

        $row = BookingProduct::find($id);
        $detail = BookingProductDetail::where('core_booking_product_id',$id)->get();

        if (empty($row)) {
            return redirect(route('booking_product.admin.index'));
        }
        $data = [
            'row'  => $row,
            'detail'=>$detail,
            // 'translation'  => $translation,
            // 'categories' => ProductsCategory::get()->toTree(),
            'enable_multi_lang'=>true
        ];
        return view('BookingProduct::admin.booking-detail', $data);
    }
    public function modalDetailAjax(Request $request): \Illuminate\Http\JsonResponse
    {
        $booking = BookingProduct::find($request->get('booking_id'));

        if (!$booking) {
            return response()->json('');
        }

        $content = view('BookingProduct::admin.booking-detail', compact('booking'))->render();

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
