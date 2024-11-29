<?php

namespace Modules\Form\Mails;

use App\Libraries\FormSchema\FormHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Modules\Form\Models\FormEntry;

class SendMoverFormMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $formId;
    public $isTesting;
    public $data;

    /**
     * Create a new message instance.
     *
     */
    public function __construct(string $clientName, int $formId, $data, $isTesting = false)
    {
        $this->clientName = $clientName;
        $this->formId = $formId;
        $this->data = $data;
        $this->isTesting = $isTesting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->subject(trans('mail.mover_mail_subject'))
            ->view('Form::mail.admin_mover_mail')
            ->attach(Storage::path(getMoverFormFolderPath(getMoverFormFileName($this->formId))), [
                'name' => getMoverFormFileName($this->formId),
                'mime' => 'application/pdf',
            ]);
    }

}
