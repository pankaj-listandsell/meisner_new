<?php

namespace Modules\Form\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendMoverFormMailToClient extends Mailable
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
        return $this->subject('Umzug planen')
            ->view('Form::mail.mover_mail')
            ->attach(Storage::path(getMoverFormFolderPath(getMoverFormFileName($this->formId))), [
                'name' => getMoverFormFileName($this->formId),
                'mime' => 'application/pdf',
            ]);
    }

}
