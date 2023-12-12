<?php

namespace App\Mail\offer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class applyOfferUpdate extends Mailable
{
    use Queueable, SerializesModels;
    private $data = array(
        'prix'=>'',
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
        $this->data['prix'] = $data['prix'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pages.email.offer.applyOfferUpdate')
            ->subject('Offre modifiée')
            ->with(['data'=>$this->data]);
    }
}
