<?php

namespace App\Mail\offer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class offerApplyResponse extends Mailable
{
    use Queueable, SerializesModels;
    private $data = array(
        'objet'=>'',
        'response'=>'',
        'prix'=>'',
        'description'=>'',
        'offer'=>'',
        'name'=>'',
    );


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data['objet'] = $data['objet'];
        $this->data['response'] = $data['response'];
        $this->data['price'] = $data['price'];
        $this->data['description'] = $data['description'];
        $this->data['offer'] = $data['offer'];
        $this->data['name'] = $data['receiver'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pages.email.offer.offerApplyResponse')
        ->subject($this->data['objet'])
        ->with(['data'=>$this->data]);
    }
}
