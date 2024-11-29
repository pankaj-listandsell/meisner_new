<?php
namespace Modules\RequestQuote\Controllers;

use App\Helpers\ReCaptchaEngine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Matrix\Exception;
use Modules\RequestQuote\Emails\NotificationToAdmin;
use Modules\RequestQuote\Models\RequestQuote;
use Illuminate\Support\Facades\Validator;
use Modules\RequestQuote\Requests\StoreRequestQuoteRequest;
use Modules\Form\Mails\SendRequestQuoteFormMailToAdmin;
use Modules\Form\Mails\SendClearingFormMailToClient;

class RequestQuoteController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [
            'page_title' => __("Request Quote Page"),
            'header_transparent'=>true,
            "seo_meta" => __('page_seo.requestquote')
        ];

        return view('RequestQuote::index', $data);
    }

    // public function store(StoreContactRequest $request)
    // {
    //     $row = new Contact();
    //     $row->first_name = $request->get('firstname');
    //     $row->last_name = $request->get('surname');
    //     $row->nationality = $request->get('nationality');
    //     $row->email = $request->get('email');
    //     $row->phone = $request->get('phone');
    //     $row->subject = $request->get('subject');
    //     $row->message = $request->get('message');
    //     $row->status = 'sent';
    //     if ($row->save()) {
    //         $this->sendEmail($row);
    //         $message = "<div id='contact_1a5cc89271'>".__('Thank you for contacting us! We will get back to you soon')."</div>";
    //         return json_success_response($message, captcha_img());
    //     }
    // }


    // public function store(Request $request)
    // {

    //     $rules = [
    //         'full_name' => 'required|string|max:255',
    //         'email'     => 'required|email|max:255',
    //         'phone'     => 'required|string|max:20',
    //         'message'   => 'required|string',
    //         'captcha'   => 'required|captcha',
    //     ];

    //     $message = [
    //         'email.required' => trans('Email is Required'),
    //         'email.max' => trans('Email is invalid') . " " . trans("Contact Administrator"),
    //         'email.email' => trans('Email is invalid'),
    //         'full_name.required' => trans('The full name is required field'),
    //         'full_name.min' => trans('Full name requires at least two characters'),
    //         'full_name.max' => trans('Full name is too long'),
    //         'phone.required' => trans('Phone is required field'),
    //         'phone.numeric' => trans('Phone no is too long'),
    //         'message.required' => trans('Message is required'),
    //         'g-recaptcha-response.required' => trans('Captcha is required'),
    //         'captcha.required'  => trans('Captcha is required'),
    //         'captcha.captcha'   => trans('Captcha does not match'),
    //     ];

    //     // Validate the request
    //     $validator = Validator::make($request->all(), $rules,$message);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         // Handle AJAX requests
    //         if ($request->ajax() || $request->wantsJson()) {
    //             return response()->json(['errors' => $validator->errors()], 422);
    //         }

    //         // Handle non-AJAX requests
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     // Create a new Contact instance
    //     $contact = new Booking();
    //     $contact->first_name = $request->input('full_name');
    //     $contact->email      = $request->input('email');
    //     $contact->phone      = $request->input('phone');
    //     $contact->message    = $request->input('message');
    //     $contact->status     = 'sent';

    //     // Attempt to save the contact
    //     if ($contact->save()) {
    //         // Send notification email
    //         $this->sendEmail($contact);

    //         $successMessage = __('Thank you for contacting us! We will get back to you soon.');

    //         // Handle AJAX requests
    //         if ($request->ajax() || $request->wantsJson()) {
    //             return response()->json(['message' => $successMessage, 'captcha' => captcha_img()], 200);
    //         }

    //         // Handle non-AJAX requests
    //         return redirect()->back()->with('success', $successMessage)->with('captcha', captcha_img());
    //     }

    //     // If saving fails
    //     $errorMessage = __('Unable to send your message. Please try again later.');

    //     // Handle AJAX requests
    //     if ($request->ajax() || $request->wantsJson()) {
    //         return response()->json(['error' => $errorMessage], 500);
    //     }

    //     // Handle non-AJAX requests
    //     return redirect()->back()->with('error', $errorMessage);
    // }

    public function store(StoreRequestQuoteRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments');
            $validated['attachment'] = $path;
        }
        $validated['service'] = json_encode($validated['service']);
        $validated['extra_service'] = json_encode($validated['extra_service']);
        $requestquote = RequestQuote::create($validated);


        $this->sendEmail($requestquote);

        return redirect()->back()->with('success', 'Danke, dass du uns kontaktiert hast! Wir melden uns zeitnah bei dir.');
    }

    protected function sendEmail($requestquote){
        try {
            Mail::to(getAdminMail())->send(new NotificationToAdmin($requestquote));
        }catch (Exception $exception){
            Log::warning("Request Quote Send Mail: ".$exception->getMessage());
        }
    }

    protected function t(){
        return new NotificationToAdmin(RequestQuote::find(1));
    }
}

