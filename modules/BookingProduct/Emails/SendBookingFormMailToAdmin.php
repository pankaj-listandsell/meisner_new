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


    /**
     * Create a new message instance.
     *
     */
    public function __construct($data, $detail,$isTesting = true)
    {
        // $this->clientName = $clientName;
        $this->data = $data;
        $this->detail = $detail;
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
            ->view('BookingProduct::emails.bookingmailtoadmin');
    }

}
