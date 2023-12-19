<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FreightOffer;
use App\Models\TransportAnnouncement;
use App\Models\Carrier;
use App\Models\Shipper;
use App\Models\User;
use App\Models\Chat; 
use Session;

class CarrierChatController extends Controller
{
    public function index($offer_id)
    {
        // Récupérer l'offre associée à $offer_id depuis la base de données
        $freightOffer = FreightOffer::find($offer_id);
    
        // Vérifier si l'offre existe
       
    
        // Récupérer le nom de l'entreprise du chargeur associé à l'offre de fret
        $shipper = Shipper::find($freightOffer->fk_shipper_id);
    
        // Récupérer les détails de l'annonce de transport liée à cette offre
        $transportAnnouncement = TransportAnnouncement::find($freightOffer->fk_transport_announcement_id);
    
        // Récupérer la liste des messages de ce chat
        $chatMessages = Chat::where('fk_annonce_id', $offer_id)
            ->orderBy('created_at', 'asc')
            ->get();
    
        return view('pages.chat.carrier_chat', [
            'freightOffer' => $freightOffer,
            'transportAnnouncement' => $transportAnnouncement,
            'shipper' => $shipper,
            'chatMessages' => $chatMessages, // Passer la liste des messages à la vue
        ]);
    }
    public function reply($offer_id)
    {
        // Récupérer l'offre associée à $offer_id depuis la base de données
        $freightOffer = FreightOffer::find($offer_id);
    
        // Vérifier si l'offre existe
        

        if ($freightOffer->status_message == 1) {
            $freightOffer->status_message = 3;
            $freightOffer->save();
}
    
        // Récupérer le nom de l'entreprise du transporteur associé à l'offre de fret
        $carrier = Carrier::find($freightOffer->fk_carrier_id);
    
        // Récupérer les détails de l'annonce de transport liée à cette offre
        $transportAnnouncement = TransportAnnouncement::find($freightOffer->fk_transport_announcement_id);
    
        // Récupérer la liste des messages de ce chat
        $chatMessages = Chat::where('fk_annonce_id', $offer_id)
            ->orderBy('created_at', 'asc')
            ->get();
    
        return view('pages.chat.reply_carrier_chat', [
            'freightOffer' => $freightOffer,
            'transportAnnouncement' => $transportAnnouncement,
            'carrier' => $carrier,
            'chatMessages' => $chatMessages, // Passer la liste des messages à la vue
        ]);
    }

    public function sendMessage(Request $request, $offer_id)
    {
        // Valider les données du formulaire de message ici si nécessaire
        $request->validate([
            'message' => 'required|string',
        ]);
    
        // Récupérer l'offre de fret associée
        $freightOffer = FreightOffer::find($offer_id);
    
       
    
        $message = new Chat();
        $message->message = $request->input('message');
        $message->status = 0; // Statut par défaut du message (peut être 0 ou 1)
        $message->fk_user_id = session('userId');
        $message->fk_annonce_id = $offer_id;
    
        $message->save();
    
        // Mettre à jour le champ "status_message" de la table "freight_offer" à 1
        if ($freightOffer) {
            $freightOffer->status = 1;
            $freightOffer->save();
        }
    
        return view('sendMessage', [
            'freightOffer' => $freightOffer,
        ])->with('success', 'Message envoyé avec succès');
        //return redirect()->back()->with('success', 'Message envoyé avec succès');
    }
    

    
}
