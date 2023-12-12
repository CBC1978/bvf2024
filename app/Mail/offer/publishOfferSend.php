<?php

namespace App\Mail\offer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class publishOfferSend extends Mailable
{
    use Queueable, SerializesModels;
    private $data = array(
        'origin'=>'',
        'destination'=>'',
        'description'=>'',
        'name'=>'',
    );

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data['name'] = $data['name'];
        $this->data['description'] = $data['description'];
        $this->data['origin'] = $data['origin'];
        $this->data['destination'] = $data['destination'];
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pages.email.offer.publishOfferSend')
            ->subject('Offre publiée')
            ->with(['data'=>$this->data]);
    }
}
