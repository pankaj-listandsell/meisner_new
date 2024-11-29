<?php
/**
 * Created by PhpStorm.
 * User: dunglinh
 * Date: 6/4/19
 * Time: 20:49
 */

namespace Modules\RequestQuote\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\RequestQuote\Models\RequestQuote;

class NotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $requestquote;

    public function __construct(RequestQuote $requestquote)
    {
        $this->requestquote = $requestquote;
    }

    public function build()
    {
        return $this->subject(__('Kostenloses Angebot'))->view('RequestQuote::emails.notification')->with([
            'requestquote' => $this->requestquote,
        ]);
    }
}
