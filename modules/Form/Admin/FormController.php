<?php
namespace Modules\Form\Admin;

use App\Libraries\FormSchema\Form\ClearingForm;
use App\Libraries\FormSchema\Form\CrimeCleaningForm;
use App\Libraries\FormSchema\Form\MoverForm;
use App\Libraries\FormSchema\Form\PaintingForm;
use App\Libraries\FormSchema\FormHelper;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mavinoo\Batch\BatchFacade;
use Modules\AdminController;
use Modules\Contact\Models\Contact;
use Modules\Booking\Models\Booking;
use Modules\Form\Enums\FormTypes;
use Modules\Form\Models\FormEntry;
use Modules\Form\Requests\Admin\UpdateFormRequest;
use Modules\Language\Models\Language;
use Modules\Form\Models\Form;
use Modules\RequestQuote\Models\RequestQuote;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FormController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('admin.form.index'));
        parent::__construct();
    }


    /*public function index(Request $request)
    {
        $this->checkPermission('form_view');
        $query = Form::with('entries')->orderBy('id', 'desc');
        $formType = $request->query('form_type');
        $langType = $request->query('lang_type');

        if ($formType) {
            $query->where('type', 'LIKE', '%' . $formType . '%');
        }
        if ($langType) {
            $query->where('lang', 'LIKE', '%' . $langType . '%');
        }

        $data = [
            'rows'        => $query->paginate(20),
            'breadcrumbs' => [
                [
                    'name' => __('Forms'),
                    'url'  => route('admin.form.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            "languages" => Language::getActive(false),
            "locale"    => \App::getLocale(),
            'page_title'=>__("Forms Management")
        ];

        return view('Form::admin.form.index', $data);
    }*/



    public function index(Request $request)
    {
        $this->checkPermission('form_view');

        $requestParams = $request->all();

        $query = Form::select('core_forms.*',
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'contact_first_name' AND core_form_entries.form_id = core_forms.id) as first_name"),
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'contact_last_name' AND core_form_entries.form_id = core_forms.id) as last_name"),
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'contact_email' AND core_form_entries.form_id = core_forms.id) as email")
        )
            ->where('core_forms.type', FormTypes::clearing->name)
            ->whereIn('core_forms.id', $this->getFormIdsFromQuerySearch($requestParams));

        $query1 = clone $query;
        $query2 = clone $query;
        $countAll = $query1->count();
        $countUnread = $query2->where('core_forms.read', 0)->count();

        if (isset($requestParams['form_dates']) && $requestParams['form_dates'] != '') {
            $dates = $this->extractDates($requestParams['form_dates']);
            if (isset($dates['start_date']) && isset($dates['end_date'])) {
                $query->whereBetween(DB::raw('DATE(core_forms.created_at)'), [$dates['start_date'], $dates['end_date']]);
            }
        }
        if (isset($requestParams['read'])) {
            $query->where('core_forms.read', (int) ((bool)$requestParams['read']));
        }
        if (isset($requestParams['read'])) {
            $query->where('core_forms.read', (int) ((bool)$requestParams['read']));
        }
        if (isset($requestParams['lang_type']) && $requestParams['lang_type'] != '') {
            $query->where('core_forms.lang', 'LIKE', '%' . $requestParams['lang_type'] . '%');
        }

        $data = [
            'rows'        => $query->orderBy('core_forms.id', 'desc')->paginate(12),
            'countAll'    => $countAll,
            'countUnread' => $countUnread,
            'breadcrumbs' => [
                [
                    'name' => __('Forms'),
                    'url'  => route('admin.form.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Clearing Form")
        ];

        return view('Form::admin.form.clearing', $data);
    }

    /**
     * Get crime cleaning form
     *
     * @param Request $request
     * @return View
     */
    public function crimeCleaningForm(Request $request): View
    {
        $this->checkPermission('form_view');

        $requestParams = $request->all();

        $query = Form::select('core_forms.*',
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'contact_first_name' AND core_form_entries.form_id = core_forms.id) as first_name"),
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'contact_last_name' AND core_form_entries.form_id = core_forms.id) as last_name"),
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'contact_email' AND core_form_entries.form_id = core_forms.id) as email")
        )
            ->where('core_forms.type', FormTypes::crime_cleaning->name)
            ->whereIn('core_forms.id', $this->getFormIdsFromQuerySearch($requestParams));

        $query1 = clone $query;
        $query2 = clone $query;
        $countAll = $query1->count();
        $countUnread = $query2->where('core_forms.read', 0)->count();

        if (isset($requestParams['read'])) {
            $query->where('core_forms.read', (int) ((bool)$requestParams['read']));
        }
        if (isset($requestParams['read'])) {
            $query->where('core_forms.read', (int) ((bool)$requestParams['read']));
        }
        if (isset($requestParams['lang_type']) && $requestParams['lang_type'] != '') {
            $query->where('core_forms.lang', 'LIKE', '%' . $requestParams['lang_type'] . '%');
        }

        if (isset($requestParams['form_dates']) && $requestParams['form_dates'] != '') {
            $dates = $this->extractDates($requestParams['form_dates']);
            if (isset($dates['start_date']) && isset($dates['end_date'])) {
                $query->whereBetween(DB::raw('DATE(core_forms.created_at)'), [$dates['start_date'], $dates['end_date']]);
            }
        }

        $data = [
            'rows'        => $query->orderBy('core_forms.id', 'desc')->paginate(12),
            'countAll'    => $countAll,
            'countUnread' => $countUnread,
            'breadcrumbs' => [
                [
                    'name' => __('Forms'),
                    'url'  => route('admin.form.crime_cleaning')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Crime cleaning")
        ];

        return view('Form::admin.form.crime_cleaning', $data);
    }


    /**
     * Get painting form
     *
     * @param Request $request
     * @return View
     */
    public function paintingForm(Request $request): View
    {
        $this->checkPermission('form_view');

        $requestParams = $request->all();

        $query = Form::select('core_forms.*',
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'contact_first_name' AND core_form_entries.form_id = core_forms.id) as first_name"),
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'contact_last_name' AND core_form_entries.form_id = core_forms.id) as last_name"),
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'contact_email' AND core_form_entries.form_id = core_forms.id) as email")
        )
            ->where('core_forms.type', FormTypes::painting->name)
            ->whereIn('core_forms.id', $this->getFormIdsFromQuerySearch($requestParams));

        $query1 = clone $query;
        $query2 = clone $query;
        $countAll = $query1->count();
        $countUnread = $query2->where('core_forms.read', 0)->count();

        if (isset($requestParams['read'])) {
            $query->where('core_forms.read', (int) ((bool)$requestParams['read']));
        }
        if (isset($requestParams['read'])) {
            $query->where('core_forms.read', (int) ((bool)$requestParams['read']));
        }
        if (isset($requestParams['lang_type']) && $requestParams['lang_type'] != '') {
            $query->where('core_forms.lang', 'LIKE', '%' . $requestParams['lang_type'] . '%');
        }

        if (isset($requestParams['form_dates']) && $requestParams['form_dates'] != '') {
            $dates = $this->extractDates($requestParams['form_dates']);
            if (isset($dates['start_date']) && isset($dates['end_date'])) {
                $query->whereBetween(DB::raw('DATE(core_forms.created_at)'), [$dates['start_date'], $dates['end_date']]);
            }
        }

        $data = [
            'rows'        => $query->orderBy('core_forms.id', 'desc')->paginate(12),
            'countAll'    => $countAll,
            'countUnread' => $countUnread,
            'breadcrumbs' => [
                [
                    'name' => __('Forms'),
                    'url'  => route('admin.form.crime_cleaning')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Crime cleaning")
        ];

        return view('Form::admin.form.painting', $data);
    }


    /**
     * Get mover form
     *
     * @param Request $request
     * @return View
     */
    public function moverForm(Request $request): View
    {
        $this->checkPermission('form_view');

        $requestParams = $request->all();

        $query = Form::select('core_forms.*',
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'reach_name' AND core_form_entries.form_id = core_forms.id) as name"),
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'reach_email' AND core_form_entries.form_id = core_forms.id) as email")
        )
            ->where('core_forms.type', FormTypes::mover->name)
            ->whereIn('core_forms.id', $this->getFormIdsFromQuerySearchForMoverForm($requestParams));

        $query1 = clone $query;
        $query2 = clone $query;
        $countAll = $query1->count();
        $countUnread = $query2->where('core_forms.read', 0)->count();

        if (isset($requestParams['read'])) {
            $query->where('core_forms.read', (int) ((bool)$requestParams['read']));
        }
        if (isset($requestParams['read'])) {
            $query->where('core_forms.read', (int) ((bool)$requestParams['read']));
        }
        if (isset($requestParams['lang_type']) && $requestParams['lang_type'] != '') {
            $query->where('core_forms.lang', 'LIKE', '%' . $requestParams['lang_type'] . '%');
        }

        if (isset($requestParams['form_dates']) && $requestParams['form_dates'] != '') {
            $dates = $this->extractDates($requestParams['form_dates']);
            if (isset($dates['start_date']) && isset($dates['end_date'])) {
                $query->whereBetween(DB::raw('DATE(core_forms.created_at)'), [$dates['start_date'], $dates['end_date']]);
            }
        }

        $data = [
            'rows'        => $query->orderBy('core_forms.id', 'desc')->paginate(12),
            'countAll'    => $countAll,
            'countUnread' => $countUnread,
            'breadcrumbs' => [
                [
                    'name' => __('Forms'),
                    'url'  => route('admin.form.crime_cleaning')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Umzug planen")
        ];

        return view('Form::admin.form.mover', $data);
    }


    /**
     * Get popup contact form
     *
     * @param Request $request
     * @return View
     */
    public function popupContactForm(Request $request): View
    {
        $this->checkPermission('form_view');

        $requestParams = $request->all();

        $query = Form::select('core_forms.*',
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'name' AND core_form_entries.form_id = core_forms.id) as name"),
            DB::raw("(SELECT core_form_entries.value FROM core_form_entries WHERE core_form_entries.key = 'email' AND core_form_entries.form_id = core_forms.id) as email")
        )
            ->where('core_forms.type', FormTypes::popup_contact->name)
            ->whereIn('core_forms.id', $this->getFormIdsFromQuerySearchForPopupContactForm($requestParams));

        $query1 = clone $query;
        $query2 = clone $query;
        $countAll = $query1->count();
        $countUnread = $query2->where('core_forms.read', 0)->count();

        if (isset($requestParams['read'])) {
            $query->where('core_forms.read', (int) ((bool)$requestParams['read']));
        }
        if (isset($requestParams['read'])) {
            $query->where('core_forms.read', (int) ((bool)$requestParams['read']));
        }
        if (isset($requestParams['lang_type']) && $requestParams['lang_type'] != '') {
            $query->where('core_forms.lang', 'LIKE', '%' . $requestParams['lang_type'] . '%');
        }

        if (isset($requestParams['form_dates']) && $requestParams['form_dates'] != '') {
            $dates = $this->extractDates($requestParams['form_dates']);
            if (isset($dates['start_date']) && isset($dates['end_date'])) {
                $query->whereBetween(DB::raw('DATE(core_forms.created_at)'), [$dates['start_date'], $dates['end_date']]);
            }
        }

        $data = [
            'rows'        => $query->orderBy('core_forms.id', 'desc')->paginate(12),
            'countAll'    => $countAll,
            'countUnread' => $countUnread,
            'breadcrumbs' => [
                [
                    'name' => __('Forms'),
                    'url'  => route('admin.form.crime_cleaning')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Contact Form")
        ];

        return view('Form::admin.form.popup_contact', $data);
    }


    /**
     * Get contact form
     *
     * @param Request $request
     * @return View
     */
    public function contactForm(Request $request): View
    {
        $this->checkPermission('contact_manage');

        $s = $request->query('s');
        $datapage = New Contact;
        if ($s) {
            $datapage->where(function ($query) use ($s){
                $query->where(DB::raw('CONCAT(first_name," ", last_name)'), 'LIKE', '%' . $s . '%')
                    ->orWhere('email','LIKE', '%' . $s . '%')
                    ->orWhere('message','LIKE', '%' . $s . '%');
            });
        }

        $data = [
            'rows'        => $datapage->paginate(20),
            'breadcrumbs' => [
                [
                    'name' => __('Forms'),
                    'url'  => route('admin.form.crime_cleaning')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Contact::admin.index', $data);
    }


    /**
     * Get contact form
     *
     * @param Request $request
     * @return View
     */
    // public function bookingForm(Request $request): View
    // {
    //     $this->checkPermission('booking_manage');

    //     $s = $request->query('s');
    //     $datapage = New Booking;
    //     if ($s) {
    //         $datapage->where(function ($query) use ($s){
    //             $query->where(DB::raw('CONCAT(first_name," ", last_name)'), 'LIKE', '%' . $s . '%')
    //                 ->orWhere('email','LIKE', '%' . $s . '%')
    //                 ->orWhere('message','LIKE', '%' . $s . '%');
    //         });
    //     }

    //     $data = [
    //         'rows'        => $datapage->paginate(20),
    //         'breadcrumbs' => [
    //             [
    //                 'name' => __('Forms'),
    //                 'url'  => route('admin.form.crime_cleaning')
    //             ],
    //             [
    //                 'name'  => __('All'),
    //                 'class' => 'active'
    //             ],
    //         ]
    //     ];
    //     return view('Booking::admin.index', $data);
    // }

    /**
     * Get contact form
     *
     * @param Request $request
     * @return View
     */
    public function bookingproductForm(Request $request): View
    {
        $this->checkPermission('booking_manage');
        $s = $request->query('s');
        $datapage = New Booking;
        if ($s) {
            $datapage->where(function ($query) use ($s){
                $query->where(DB::raw('CONCAT(first_name," ", last_name)'), 'LIKE', '%' . $s . '%')
                    ->orWhere('email','LIKE', '%' . $s . '%')
                    ->orWhere('message','LIKE', '%' . $s . '%');
            });
        }

        $data = [
            'rows'        => $datapage->paginate(20),
            'breadcrumbs' => [
                [
                    'name' => __('Forms'),
                    'url'  => route('admin.form.crime_cleaning')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('BookingProduct::admin.index', $data);
    }

    /**
     * Get contact form
     *
     * @param Request $request
     * @return View
     */
    public function requestquoteForm(Request $request): View
    {
        $this->checkPermission('requestquote_manage');

        $s = $request->query('s');
        $datapage = New RequestQuote();
        if ($s) {
            $datapage->where(function ($query) use ($s){
                $query->where('name', 'LIKE', '%' . $s . '%')
                    ->orWhere('email','LIKE', '%' . $s . '%')
                    ->orWhere('phone','LIKE', '%' . $s . '%')
                    ->orWhere('service','LIKE', '%' . $s . '%');
            });
        }

        $data = [
            'rows'        => $datapage->paginate(20),
            'breadcrumbs' => [
                [
                    'name' => __('Forms'),
                    'url'  => route('admin.form.requestquote')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('RequestQuote::admin.index', $data);
    }



    /**
     * Download Mover File
     *
     * @param Request $request
     * @param $formId
     * @return RedirectResponse|BinaryFileResponse
     */
    public function downloadMoverFile(Request $request, $formId)
    {
        $filePath = Storage::path(getMoverFormFolderPath(getMoverFormFileName($formId)));
        if (!File::exists($filePath)) {
            return redirect()->back()->with('error', trans('File not found'));
        }

        return response()->download($filePath);
    }


    public function view(Request $request, $id)
    {
        $this->checkPermission('form_create');

        $form = Form::find($id);

        if (empty($form)) {
            return redirect(route('admin.form.index'))->with('error', __('Form not found!'));
        }

        if ($form->read == 0) {
            $form->read = 1;
            $form->save();
        }

        $formEntries = FormEntry::where('form_id', $form->id)->get();

        return view('Form::admin.form.view', compact('form', 'formEntries'));
    }


    public function edit(Request $request, $id)
    {
        $this->checkPermission('form_create');

        $form = Form::find($id);

        if (empty($form)) {
            return redirect(route('admin.form.index'))->with('error', __('Form not found!'));
        }

        $formEntries = FormEntry::where('form_id', $form->id)->get();
        $schema = getFormSchemaByType($form->type);

        return view('Form::admin.form.edit', compact('form', 'formEntries', 'schema'));
    }


    /**
     * Update Form
     *
     * @param UpdateFormRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateFormRequest $request, $id)
    {
        $schema = getFormSchemaByType($request->get('form_type'));

        $formEntries = [];
        foreach (FormHelper::getDataFromRequest($schema, $request->get('form_id'), 1) as $field) {
            $formEntries[] = [
                'form_id'   => $request->get('form_id'),
                'key'       => $field['name'],
                'value'     => $field['value'],
            ];
        }

        FormEntry::massUpdate(
            values: $formEntries,
            uniqueBy: ['form_id', 'key']
        );

        return redirect()->back()->with('success', trans('Updated successfully'));
    }

    /**
     * Update Read Status
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function updateReadStatus(Request $request, $id): RedirectResponse
    {
        if (!$request->has('read')) {
            return redirect()->route('admin.form.index')->with(trans('Invalid Request'));
        }

        $form = Form::where('id', $id)->first();

        if (!$form) {
            return redirect()->route('admin.form.index')->with(trans('Invalid Request'));
        }

        $form->read = (int) ((bool) $request->get('read'));
        $form->save();

        return redirect()->back()->with(trans('Updated successfully'));
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('form_update');

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        if ($action == "delete") {
            if ($this->hasPermission('form_delete')) {
                Form::whereIn("id", $ids)->delete();
            }
        }
        if ($action == "read") {
            if ($this->hasPermission('form_delete')) {
                Form::whereIn("id", $ids)->update(['read' => 1]);
            }
        }
        if ($action == "unread") {
            if ($this->hasPermission('form_delete')) {
                Form::whereIn("id", $ids)->update(['read' => 0]);
            }
        }
        return redirect()->back()->with('success', __(($action == 'delete' ? 'Delete' : 'Update').' success!'));
    }

    /**
     * Get Form Ids from Query Search
     *
     * @param array $requestParams
     * @return array
     */
    private function getFormIdsFromQuerySearch(array $requestParams): array
    {
        $rows = FormEntry::where(function ($query) use ($requestParams) {
            if (hasInput($requestParams['name'] ?? '')) {
                $query->where('key', 'contact_first_name')->where('value', 'LIKE', '%'.($requestParams['name'] ?? '').'%');
            }
        })->orWhere(function($query) use ($requestParams) {
            if (hasInput($requestParams['name'] ?? '')) {
                $query->where('key', 'contact_last_name')->where('value', 'LIKE', '%'.($requestParams['name'] ?? '').'%');
            }
        })->orWhere(function($query) use ($requestParams) {
            if (hasInput($requestParams['email'] ?? '')) {
                $query->where('key', 'contact_email')->where('value', 'LIKE', '%'.($requestParams['email'] ?? '').'%');
            }
        })
            ->groupBy('form_id')
            ->get();

        return (array) $rows->pluck('form_id')->toArray();
    }

    /**
     * Get Form Ids from Query Search
     *
     * @param array $requestParams
     * @return array
     */
    private function getFormIdsFromQuerySearchForMoverForm(array $requestParams): array
    {
        $rows = FormEntry::where(function ($query) use ($requestParams) {
            if (hasInput($requestParams['name'] ?? '')) {
                $query->where('key', 'reach_name')->where('value', 'LIKE', '%'.($requestParams['name'] ?? '').'%');
            }
        })->orWhere(function($query) use ($requestParams) {
            if (hasInput($requestParams['email'] ?? '')) {
                $query->where('key', 'reach_email')->where('value', 'LIKE', '%'.($requestParams['email'] ?? '').'%');
            }
        })
            ->groupBy('form_id')
            ->get();

        return (array) $rows->pluck('form_id')->toArray();
    }


    /**
     * Get Form Ids from Query Search
     *
     * @param array $requestParams
     * @return array
     */
    private function getFormIdsFromQuerySearchForPopupContactForm(array $requestParams): array
    {
        $rows = FormEntry::where(function ($query) use ($requestParams) {
            if (hasInput($requestParams['name'] ?? '')) {
                $query->where('key', 'name')->where('value', 'LIKE', '%'.($requestParams['name'] ?? '').'%');
            }
        })->orWhere(function($query) use ($requestParams) {
            if (hasInput($requestParams['email'] ?? '')) {
                $query->where('key', 'email')->where('value', 'LIKE', '%'.($requestParams['email'] ?? '').'%');
            }
        })
            ->groupBy('form_id')
            ->get();

        return (array) $rows->pluck('form_id')->toArray();
    }


    private function extractDates($dates): array
    {
        if (!empty($dates)) {
            if (str_contains($dates, '/')) {
                $modified_dates = array_map('trim', explode("/",$dates));
                $start_date = $modified_dates[0];
                $end_date = $modified_dates[1];
                if (isValidDate($start_date) && isValidDate($end_date)) {
                    return [
                        'start_date' => $start_date,
                        'end_date' => $end_date
                    ];
                }
            }
        }
        return [];
    }

}
