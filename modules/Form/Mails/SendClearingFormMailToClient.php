<?php

namespace Modules\Form\Mails;

use App\Libraries\FormSchema\FormHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Form\Models\FormEntry;

class SendClearingFormMailToClient extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $formId;
    public $isTesting;

    /**
     * Create a new message instance.
     *
     */
    public function __construct(string $clientName, int $formId, $isTesting = false)
    {
        $this->clientName = $clientName;
        $this->formId = $formId;
        $this->isTesting = $isTesting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $formEntries = FormEntry::where('form_id', $this->formId)->get();

        return $this
            ->subject(trans('mail.clearing_mail_subject'))
            ->view('Form::mail.form_mail', compact('formEntries'));
    }

}
