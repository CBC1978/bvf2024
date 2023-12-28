<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ValidatedRegisterEmails extends Mailable
{
    use Queueable, SerializesModels;

    public $name ;
    /**
     * Create a new message instance.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pages.email.validatedRegisterEmail')
            ->subject('Email Vérifié')
            ->with(['name'=>$this->name]);
    }
}
