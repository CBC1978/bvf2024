<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\FreightAnnouncement;
use App\Models\Shipper;
use App\Models\TransportOffer;
use Illuminate\Http\Request;
use App\Models\Carrier;
use App\Models\User;
use Session;

class ShipperChatController extends Controller
{
    //
        public function index($offer_id)
        {
            // Récupérer l'offre associée à $offer_id depuis la base de données
            $transportOffer = TransportOffer::find($offer_id);
        
            // Vérifier si l'offre existe
           
          // Récupérer le nom de l'entreprise du transporteur associé à l'offre de transport
        $carrier = Carrier::find($transportOffer->fk_carrier_id);
            // Récupérer le nom de l'entreprise du transporteur associé à l'offre de fret
           // $shipper = Shipper::find($transportOffer->fk_shipper_id);
        
            // Récupérer les détails de l'annonce  liée à cette offre
            $freightAnnouncement = FreightAnnouncement::find($transportOffer->fk_freight_announcement_id);
        
            // Récupérer la liste des messages de ce chat
            $chatMessages = Chat::where('fk_annonce_id', $offer_id)
                ->orderBy('created_at', 'asc')
                ->get();
                // Récupérer le nom de l'utilisateur pour chaque message
                foreach ($chatMessages as $message) {
                            $user = User::find($message->fk_user_id);
                            $message->username = $user ? $user->username : 'Utilisateur inconnu';
                          }
        
            return view('pages.chat.shipper_chat', [
                'transportOffer' => $transportOffer,
                'freightAnnouncement' => $freightAnnouncement,
                //'shipper' => $shipper,
                'carrier' => $carrier,
                'chatMessages' => $chatMessages, // Passer la liste des messages à la vue
            ]);
        }
        public function reply($offer_id)
        {
            // Récupérer l'offre associée à $offer_id depuis la base de données
            $transportOffer = TransportOffer::find($offer_id);
        
            // Vérifier si l'offre existe
           
            // Si status_message est égal à 2, mettez à jour à 3
            if ($transportOffer->status == 2) {
                $transportOffer->status == 3;
                $transportOffer->save();
            }
        
            // Récupérer le nom de l'entreprise du chargeur associé à l'offre de fret
            $shipper = Shipper::find($transportOffer->fk_shipper_id);
        
            // Récupérer les détails de l'annonce liée à cette offre
            $freightAnnouncement = FreightAnnouncement::find($transportOffer->fk_freight_announcement_id);
        
            // Récupérer la liste des messages de ce chat
            $chatMessages = Chat::where('fk_annonce_id', $offer_id)
                ->orderBy('created_at', 'asc')
                ->get();

                  // Récupérer le nom de l'utilisateur pour chaque message
                  foreach ($chatMessages as $message) {
                    $user = User::find($message->fk_user_id);
                    $message->username = $user ? $user->username : 'Utilisateur inconnu';
                  }

        
        
            return view('pages.chat.reply_shipper_chat', [
                'transportOffer' => $transportOffer,
                'freightAnnouncement' => $freightAnnouncement,
                'shipper' => $shipper,
                'chatMessages' => $chatMessages, // Passer la liste des messages à la vue
            ]);
        }
        //public function sendMessage($offer_id, Request $request)
        public function sendMessage(Request $request, $offer_id)
    {
        // Valider les données du formulaire de message ici si nécessaire
        $request->validate([
            'message' => 'required|string',
        ]);

        


        $message = new Chat();
        $message->message = $request->input('message');
        $message->status = 0; // Statut par défaut du message (peut être 0 ou 1)
        $message->fk_user_id = session('userId');
        $message->fk_annonce_id = $offer_id;
                                
    
        $message->save();

         // Mettre à jour le champ "status_message" de la table "transport_offer" à 2
        $transportOffer = TransportOffer::find($offer_id);
          if ($transportOffer) {
           $transportOffer->status = 2;
           $transportOffer->save();
    }

    
        return redirect()->back()->with('success', 'Message envoyé avec succès');
    }
}
