<?php
namespace Modules\BookingProduct\Controllers;

// use App\Helpers\ReCaptchaEngine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Matrix\Exception;
use Modules\BookingProduct\Emails\NotificationToAdmin;
// use Illuminate\Support\Facades\Validator;
use Modules\BookingProduct\Models\BookingProduct;
use Modules\BookingProduct\Emails\SendBookingFormMailToAdmin;
use Modules\BookingProduct\Emails\SendBookingFormMailToClient;
use Modules\Products\Models\Products;
use Illuminate\Support\Str;
use Modules\BookingProduct\Models\BookingProductDetail;
use Modules\Products\Models\ProductsCategory;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [
            'page_title' => __("Booking Product Page"),
            'header_transparent'=>true,
            "seo_meta" => __('page_seo.booking')
        ];

        return view('BookingProduct::index', $data);
    }

    public function category_products (Request $request)
    {
        $getProducts = Products::select('id','title','price','content','image_id')->where('cat_id',$request->id)->get();
        $viewRender = "";
        $viewRender = view('BookingProduct::.frontend.blocks.booking.category_products',compact('getProducts'))->render();
        return response()->json(['status'=>1,'data'=>$viewRender]);
    }

    public function cartdata (Request $request)
    {
        $result = [];
        $net_amount = 0;
        foreach($request->cart_item as $val){
            $getCart = explode(',',$val);
            $prodid = $getCart[0];
            $qty = $getCart[1];
            $getProducts = Products::select('id','title','price','content','image_id')->where('id',$prodid)->first();
            $result[] = ['id'=>$getProducts->id,'title'=>$getProducts->title,'price'=>$getProducts->price,'qty'=>$qty,'image_id'=>$getProducts->image_id];
            $net_amount += $getProducts->price*$qty;
        }
        $viewRender = "";
        $viewRender = view('BookingProduct::.frontend.blocks.booking.cart',compact('result'))->render();
        $vatTax = setting_item_with_lang('vat', 'de');
        $vatTaxAmount = ($net_amount * $vatTax) / 100;
        $additional_cost = 0;
        $gross_total_amount = $net_amount + $additional_cost;
        $summary = ['address'=>$request->address,'total_pieces'=>count($request->cart_item),'net_amount'=>$net_amount,'vat'=>$vatTax,'vatTaxAmount'=>floor($vatTaxAmount * 100) / 100, 'max_order_amount'=>setting_item_with_lang('max_order_amount', 'de'),'additional_cost'=>$additional_cost,'gross_total_amount'=>$gross_total_amount];
        return response()->json(['status'=>1,'data'=>$viewRender,'summary'=>$summary]);
    }
    
    public function booking(Request $request)
    {
        $booking_id = strtoupper(Str::random(4)) . '-' . rand(10000, 99999) . strtoupper(Str::random(3));
        $row = new BookingProduct();
        $row->booking_id = $booking_id;
        $row->address = $request->address;
        $row->building = $request->building;
        $row->city = $request->city;
        $row->zipcode = $request->zipcode;
        $row->flour = $request->flour;
        $row->full_name = $request->gender.' '.$request->fname.' '.$request->lname;
        $row->email = $request->email;
        $row->phone = $request->telephone;
        $row->date = $request->date;
        $row->time = $request->time;
        $row->note = $request->note;
        $row->company_name = $request->company_name;
        $row->vat_id = $request->vat_id;
        $row->total_pieces = $request->total_pieces_cart;
        $row->net_amount = $request->net_amount_cart;
        $row->vat = $request->vat_cart_amount;
        $row->vat_percent = setting_item_with_lang('vat', 'de');
        $row->additional_cost = $request->additional_cost_cart;
        $row->grand_amount = $request->grand_amount_cart;
        $row->status = '1';
        if ($row->save()) {
            $detail = [];
            foreach($request->cart_item as $val){
                $getCart = explode(',',$val);
                $prodid = $getCart[0];
                $qty = $getCart[1];
                $product = Products::select('id','title','cat_id','price','image_id')->where('id',$prodid)->first();
                $detail[] = ['core_booking_product_id'=>$row->id,'booking_id'=>$booking_id,'core_products_category_id'=>$product->cat_id,'product_id'=>$product->id,'product_title'=>$product->title,'qty'=>$qty,'unit_price'=>$product->price,'total_price'=>$qty*$product->price,'image_id'=>$product->image_id];
            }
            $result = BookingProductDetail::insert($detail);
            if($result){
                $detail = BookingProductDetail::where('core_booking_product_id',$row->id)->get();
                // Generate PDF
                $pdf = Pdf::loadView('BookingProduct::.frontend.blocks.booking.pdf', compact('row', 'detail'));
                $pdfPath = storage_path('app/public/booking_product/invoice_' . $row->id . '.pdf');
                $pdf->save($pdfPath);
                // Send Mail
                try {
                    Mail::to($row->email)->send(new SendBookingFormMailToClient($row, $detail, $pdfPath, false));
                    Mail::to(getAdminMail())->send(new SendBookingFormMailToAdmin($row, $detail, $pdfPath, false));
                    unlink($pdfPath);
                    $request->session()->flash('success', 'Ihre Buchung erfolgreich gebucht');
                    return response()->json(['status'=>1,'message'=>'Ihre Buchung erfolgreich gebucht']);
                }catch (Exception $exception){
                    // Log::warning("Booking Send Mail: ".$exception->getMessage());
                    $request->session()->flash('success', 'Ihre Buchung erfolgreich gebucht');
                    return response()->json(['status'=>1,'message'=>'Ihre Buchung erfolgreich gebucht']);
                }
                $request->session()->flash('success', 'Ihre Buchung erfolgreich gebucht');
                return response()->json(['status'=>1,'message'=>'Ihre Buchung erfolgreich gebucht']);
            }else{
                return response()->json(['status'=>0,'message'=>'Something went wrong!, Please try again.']);
            }
        }else{
            return response()->json(['status'=>0,'message'=>'Something went wrong!, Please try again.']);
        }
    }

    public function search_category (Request $request)
    {
        //Search Category
        if($request->type == 1){
            if(!empty($request->key)){
                $category = ProductsCategory::select('id','name','image_id')->where('name','LIKE', '%' . $request->key . '%')->get();
            }else{
                $category = ProductsCategory::select('id','name','image_id')->get();
            }
            $categoryList = '';
            if(count($category) > 0){
                foreach ($category as $val){
                    $image_url = get_file_url($val->image_id, 'full');
                    $image_details = get_file_details($val->image_id, '#');
                    $categoryList .='<div class="category-box" onclick="category_products('.$val->id.')" style="display: block;">'.
                                '<img src="'.$image_url.'" title="" alt=""><p>'.$val->name.'</p></div>';
                }
                return response()->json(['status'=>1, 'type'=>1,'data'=>$categoryList]);
            }else{
                return response()->json(['status'=>0, 'type'=>1,'data'=>'No data found']);
            }
        }
        //Search category of products
        if($request->type == 2){
            
            if(!empty($request->key)){
                $getProducts = Products::select('id','title','price','content','image_id')->where('cat_id',$request->category)->where('title','LIKE', '%' . $request->key . '%')->get();
                if(count($getProducts) > 0){
                    $viewRender = view('BookingProduct::.frontend.blocks.booking.category_products',compact('getProducts'))->render();
                    return response()->json(['status'=>1, 'type'=>2,'data'=>$viewRender]);
                }else{
                    return response()->json(['status'=>0, 'type'=>2,'data'=>'No data found']);
                }
            }else{
                $getProducts = Products::select('id','title','price','image_id')->where('cat_id',$request->category)->get();
                $viewRender = view('BookingProduct::.frontend.blocks.booking.category_products',compact('getProducts'))->render();
                return response()->json(['status'=>1, 'type'=>2,'data'=>$viewRender]);
            }
        }
    }
}

