<?php
namespace Modules\Dashboard\Admin;


use Modules\AdminController;
use Modules\Contact\Models\Contact;
use Modules\Form\Models\Form;
use Modules\Page\Models\Page;

class DashboardController extends AdminController
{
    public function index()
    {
        $data = [
            'totalPages' => Page::where('status', 'publish')->count(),
            'totalForms' => Form::count(),
            'totalContacts' => Contact::count(),
        ];
        return view('Dashboard::index', $data);
    }

}
