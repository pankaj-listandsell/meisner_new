<?php

namespace Modules\BookingProduct\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendBookingFormMailToClient extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $detail;
    public $pdfPath;
    public $isTesting;

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
        return $this->subject('Produkt buchen')
            ->view('BookingProduct::emails.bookingmailtoclient')
            ->attach($this->pdfPath, [
                'as' => 'Invoice_' . $this->data->id . '.pdf',
                'mime' => 'application/pdf',
            ]);
    }

}
