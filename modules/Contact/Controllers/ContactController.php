<?php
namespace Modules\Contact\Controllers;

use App\Helpers\ReCaptchaEngine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Matrix\Exception;
use Modules\Contact\Emails\NotificationToAdmin;
use Modules\Contact\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Modules\Contact\Requests\StoreContactRequest;
use Modules\RequestQuote\Models\RequestQuote;
use Modules\RequestQuote\Requests\StoreRequestQuoteRequest;
use Modules\RequestQuote\Emails\NotificationToAdmin as NotificationToAdminQ;

class ContactController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [
            'page_title' => __("Contact Page"),
            'header_transparent'=>true,
            "seo_meta" => __('page_seo.contact')
        ];

        return view('Contact::index', $data);
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


    public function store(Request $request)
    {

        $rules = [
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:20',
            'message'   => 'required|string',
            'captcha'   => 'required|captcha',
        ];

        $message = [
            'email.required' => trans('Dieses Feld ist erforderlich'),
            'email.max' => trans('Email is invalid') . " " . trans("Contact Administrator"),
            'email.email' => trans('Email is invalid'),
            'full_name.required' => trans('Dieses Feld ist erforderlich'),
            'full_name.min' => trans('Full name requires at least two characters'),
            'full_name.max' => trans('Full name is too long'),
            'phone.required' => trans('Dieses Feld ist erforderlich'),
            'phone.numeric' => trans('Phone no is too long'),
            'message.required' => trans('Dieses Feld ist erforderlich'),
            'g-recaptcha-response.required' => trans('Dieses Feld ist erforderlich'),
            'captcha.required'  => trans('Dieses Feld ist erforderlich'),
            'captcha.captcha'   => trans('Captcha stimmt nicht überein'),
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules,$message);

        // Check if validation fails
        if ($validator->fails()) {
            // Handle AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Handle non-AJAX requests
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new Contact instance
        $contact = new Contact();
        $contact->first_name = $request->input('full_name');
        $contact->email      = $request->input('email');
        $contact->phone      = $request->input('phone');
        $contact->message    = $request->input('message');
        $contact->status     = 'sent';

        // Attempt to save the contact
        if ($contact->save()) {
            // Send notification email
            $this->sendEmail($contact);

            $successMessage = __('Danke, dass du uns kontaktiert hast! Wir melden uns zeitnah bei dir.');

            // Handle AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => $successMessage, 'captcha' => captcha_img()], 200);
            }

            // Handle non-AJAX requests
            return redirect()->back()->with('success', $successMessage)->with('captcha', captcha_img());
        }

        // If saving fails
        $errorMessage = __('Unable to send your message. Please try again later.');

        // Handle AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['error' => $errorMessage], 500);
        }

        // Handle non-AJAX requests
        return redirect()->back()->with('error', $errorMessage);
    }

    protected function sendEmail($contact){
        try {
            Mail::to(getAdminMail())->send(new NotificationToAdmin($contact));
        }catch (Exception $exception){
            Log::warning("Contact Send Mail: ".$exception->getMessage());
        }
    }

    protected function t(){
        return new NotificationToAdmin(Contact::find(1));
    }

    public function storequote(StoreRequestQuoteRequest $request)
    {
        $validated = $request->validated();

        $requestquote = RequestQuote::create($validated);

        $this->sendEmailq($requestquote);

        return redirect()->back()->with('success', 'Danke, dass du uns kontaktiert hast! Wir melden uns zeitnah bei dir.');
    }

    protected function sendEmailq($requestquote){
        try {
            Mail::to(getAdminMail())->send(new NotificationToAdminQ($requestquote));
        }catch (Exception $exception){
            Log::warning("Request Quote Send Mail: ".$exception->getMessage());
        }
    }
}

