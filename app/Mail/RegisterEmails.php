<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterEmails extends Mailable
{
    use Queueable, SerializesModels;
    public $subject ;
    public $name ;
    public $code ;
    /**
     * Create a new message instance.
     */
    public function __construct($name,$subject, $code)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.registerEmail')
            ->subject($this->subject)
            ->with(['code'=>$this->code]);
    }
}
