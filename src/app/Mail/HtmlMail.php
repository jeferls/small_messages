<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class HtmlMail extends Mailable
{
    /** @var string */
    public $html;

    public function __construct(string $html, string $subject)
    {
        $this->html = $html;
        $this->subject($subject);
    }

    public function build()
    {
        return $this->html($this->html);
    }
}
