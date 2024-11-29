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
    public $isTesting;

    /**
     * Create a new message instance.
     *
     */
    public function __construct($data, $detail,$isTesting = true)
    {
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
        return $this->subject('Produkt buchen')
            ->view('BookingProduct::emails.bookingmailtoclient');
    }

}
