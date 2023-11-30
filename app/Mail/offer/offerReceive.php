<?php

namespace App\Mail\offer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class offerReceive extends Mailable
{
    use Queueable, SerializesModels;

    private $data = array(
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
        $this->data['prix'] = $data['price'];
        $this->data['description'] = $data['description'];
        $this->data['offer'] = $data['offer'];
        $this->data['name'] = $data['sender'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pages.email.offer.offerReceive')
            ->subject('Offre reçue')
            ->with(['data'=>$this->data]);
    }
}
