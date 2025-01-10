<?php

namespace Modules\BookingProduct\Emails;

use App\Libraries\FormSchema\FormHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Modules\Form\Models\FormEntry;

class SendBookingFormMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    // public $clientName;
    public $isTesting;
    public $data;
    public $detail;
    public $pdfPath;


    /**
     * Create a new message instance.
     *
     */
    public function __construct($data, $detail, $pdfPath, $isTesting = true)
    {
        $this->data = $data;
        $this->detail = $detail;
        $this->pdfPath = $pdfPath;
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
            ->subject(trans('Produkt buchen'))
            ->view('BookingProduct::emails.bookingmailtoadmin')
            ->attach($this->pdfPath, [
                'as' => 'Invoice_' . $this->data->id . '.pdf',
                'mime' => 'application/pdf',
            ]);
    }

}
