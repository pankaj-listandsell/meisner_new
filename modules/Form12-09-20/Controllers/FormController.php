<?php
namespace Modules\Form\Controllers;

use App\Libraries\FormSchema\Form\ClearingForm;
use App\Libraries\FormSchema\Form\CrimeCleaningForm;
use App\Libraries\FormSchema\Form\MoverForm;
use App\Libraries\FormSchema\Form\PaintingForm;
use App\Libraries\FormSchema\Form\PopupContractForm;
use App\Libraries\FormSchema\FormHelper;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Modules\Form\Enums\FormTypes;
use Modules\Form\Mails\SendClearingFormMailToClient;
use Modules\Form\Mails\SendCrimeCleaningFormMailToClient;
use Modules\Form\Mails\SendMoverFormMailToAdmin;
use Modules\Form\Mails\SendMoverFormMailToClient;
use Modules\Form\Mails\SendPaintingFormMailToClient;
use Modules\Form\Mails\SendPopupContactFormMailToClient;
use Modules\Form\Models\FormEntry;
use Modules\Form\Requests\RegisterClearingFormRequest;
use Modules\Form\Requests\RegisterCrimeCleaningRequest;
use Modules\Form\Requests\RegisterMoverRequest;
use Modules\Form\Requests\RegisterPaintingRequest;
use Modules\Form\Requests\RegisterPopupContactRequest;
use Modules\FrontendController;
use Modules\Language\Models\Language;
use Modules\Form\Models\Form;
use Barryvdh\DomPDF\Facade\Pdf;

class FormController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Clearing Form
     *
     * @param Request $request
     * @return View
     */
    public function clearingForm(Request $request): View
    {
        $data = [
            "languages" => Language::getActive(false),
            "locale"    => app()->getLocale(),
        ];
        return view('Form::frontend.clearing_form', $data);
    }


    /**
     * Crime cleaning Form
     *
     * @param Request $request
     * @return View
     */
    public function crimeCleaningForm(Request $request): View
    {
        $data = [
            "languages" => Language::getActive(false),
            "locale"    => app()->getLocale(),
        ];
        return view('Form::frontend.crime_cleaning_form', $data);
    }


    /**
     * Painting Form
     *
     * @param Request $request
     * @return View
     */
    public function paintingForm(Request $request): View
    {
        $data = [
            "languages" => Language::getActive(false),
            "locale"    => app()->getLocale(),
        ];
        return view('Form::frontend.painting_form', $data);
    }


    /**
     * Mover Form
     *
     * @param Request $request
     * @return View
     */
    public function moverForm(Request $request): View
    {
        $data = [
            "languages" => Language::getActive(false),
            "locale"    => app()->getLocale(),
        ];

        return view('Form::frontend.mover_form', $data);
    }


    /**
     * Register Clearing Form
     *
     * @param RegisterClearingFormRequest $request
     * @return JsonResponse
     */
    public function registerClearingForm(RegisterClearingFormRequest $request): JsonResponse
    {
        $form = Form::create([
            'type'  => FormTypes::clearing->name,
            'lang'  => get_current_lang($request->get('lang')),
        ]);

        $formEntries = [];
        foreach (FormHelper::getDataFromRequest(ClearingForm::schema(), $form->id) as $field) {
            $formEntries[] = [
                'form_id'   => $form->id,
                'type'      => $field['type'],
                'label'     => $field['label'],
                'key'       => $field['name'],
                'value'     => $field['value']
            ];
        }

        foreach (array_chunk($formEntries, 25) as $chunkedFormEntries) {
            FormEntry::insert($chunkedFormEntries);
        }

        $name = $request->get('contact_first_name').' '.$request->get('contact_last_name');
        Mail::to(getAdminMail())->send(new SendClearingFormMailToClient($name, (int) $form->id));

        return json_success_response(__('Form entry successfully'));
    }



    /**
     * Register Crime Cleaning Form
     *
     * @param RegisterCrimeCleaningRequest $request
     * @return JsonResponse
     */
    public function registerCrimeCleaningForm(RegisterCrimeCleaningRequest $request): JsonResponse
    {
        $form = Form::create([
            'type'  => FormTypes::crime_cleaning->name,
            'lang'  => get_current_lang($request->get('lang')),
        ]);

        $formEntries = [];
        foreach (FormHelper::getDataFromRequest(CrimeCleaningForm::schema(), $form->id) as $field) {
            $formEntries[] = [
                'form_id'   => $form->id,
                'type'      => $field['type'],
                'label'     => $field['label'],
                'key'       => $field['name'],
                'value'     => $field['value']
            ];
        }

        foreach (array_chunk($formEntries, 25) as $chunkedFormEntries) {
            FormEntry::insert($chunkedFormEntries);
        }

        $name = $request->get('contact_first_name').' '.$request->get('contact_last_name');
        Mail::to(getAdminMail())->send(new SendCrimeCleaningFormMailToClient($name, (int) $form->id));

        return json_success_response(__('Form entry successfully'));
    }


    /**
     * Register Painting Form
     *
     * @param RegisterPaintingRequest $request
     * @return JsonResponse
     */
    public function registerPaintingForm(RegisterPaintingRequest $request): JsonResponse
    {
        $form = Form::create([
            'type'  => FormTypes::painting->name,
            'lang'  => get_current_lang($request->get('lang')),
        ]);

        $formEntries = [];
        foreach (FormHelper::getDataFromRequest(PaintingForm::schema(), $form->id) as $field) {
            $formEntries[] = [
                'form_id'   => $form->id,
                'type'      => $field['type'],
                'label'     => $field['label'],
                'key'       => $field['name'],
                'value'     => $field['value']
            ];
        }

        foreach (array_chunk($formEntries, 25) as $chunkedFormEntries) {
            FormEntry::insert($chunkedFormEntries);
        }

        $name = $request->get('contact_first_name').' '.$request->get('contact_last_name');
        Mail::to(getAdminMail())->send(new SendPaintingFormMailToClient($name, (int) $form->id));

        return json_success_response(__('Form entry successfully'));
    }


    /**
     * Register Painting Form
     *
     * @param RegisterMoverRequest $request
     * @return JsonResponse
     */
    public function registerMoverForm(RegisterMoverRequest $request): JsonResponse
    {
        $form = Form::create([
            'type'  => FormTypes::mover->name,
            'lang'  => get_current_lang($request->get('lang')),
        ]);

        $formEntries = [];
        foreach (FormHelper::getDataFromRequest(MoverForm::schema(), $form->id) as $field) {
            $formEntries[] = [
                'form_id'   => $form->id,
                'type'      => $field['type'],
                'label'     => $field['label'],
                'key'       => $field['name'],
                'value'     => $field['value'],
                'group'     => $field['group'] ?? '',
            ];
        }

        foreach (array_chunk($formEntries, 25) as $chunkedFormEntries) {
            FormEntry::insert($chunkedFormEntries);
        }

        $formEntries = FormEntry::where('form_id', $form->id)->get();
        $data = FormHelper::getFormEntryInSingleArray($formEntries);
        $groups = FormEntry::where('form_id', $form->id)->where('group', '!=', '')->get()->groupBy('group');
        $pdf = Pdf::loadView('Form::mail.mover_pdf', compact('data', 'groups'));
        $pdf->save(getMoverFormFolderPath(getMoverFormFileName($form->id)), 'local');

        Mail::to($request->get('reach_email'))->send(new SendMoverFormMailToClient($request->get('reach_name'), (int) $form->id));
        Mail::to(getAdminMail())->send(new SendMoverFormMailToAdmin(config('app.name').' Admin', (int) $form->id, $data));

        return json_success_response(__('Form entry successfully'));
    }


    /**
     * Store Popup Contact Form
     *
     * @param RegisterPopupContactRequest $request
     * @return JsonResponse
     */
    public function storePopupContactForm(RegisterPopupContactRequest $request): JsonResponse
    {
        $form = Form::create([
            'type'  => FormTypes::popup_contact->name,
            'lang'  => get_current_lang($request->get('lang')),
        ]);

        $formEntries = [];
        foreach (FormHelper::getDataFromRequest(PopupContractForm::schema(), $form->id) as $field) {
            $formEntries[] = [
                'form_id'   => $form->id,
                'type'      => $field['type'],
                'label'     => $field['label'],
                'key'       => $field['name'],
                'value'     => $field['value'],
                'group'     => $field['group'] ?? '',
            ];
        }

        foreach (array_chunk($formEntries, 25) as $chunkedFormEntries) {
            FormEntry::insert($chunkedFormEntries);
        }

        Mail::to(getAdminMail())->send(new SendPopupContactFormMailToClient($request->get('name'), (int) $form->id));

        return json_success_response(__('Form entry successfully'), captcha_img());
    }

    public function mailChecker()
    {
        //Mail::to('dhana@listandsell.de')->send(new SendPopupContactFormMailToClient('Dhan Kumar lama', 28));

        //return new SendMoverFormMailToClient('Mandeep', 7, 1);
        //return new SendMoverFormMailToAdmin('Admin', 7, 1);
        //Mail::to('mandeep@listandsell.de')->send(new SendMoverFormMailToClient('Mandeep', 7));
        //Mail::to(config('site.email'))->send(new SendMoverFormMailToAdmin(config('app.name').' Admin', 7));
    }

    public function pdfChecker()
    {
/*        $formEntries = FormEntry::where('form_id', 9)->get();
        $data = FormHelper::getFormEntryInSingleArray($formEntries);
        $groups = FormEntry::where('form_id', 9)->where('group', '!=', '')->get()->groupBy('group');
        $testing = 1;
        //return view('Form::mail.mover_pdf', compact('data', 'groups', 'testing'));
        $pdf = Pdf::loadView('Form::mail.mover_pdf', compact('data', 'groups'));
        return $pdf->download('invoice.pdf');*/
    }
}
