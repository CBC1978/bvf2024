<?php

namespace App\Http\Controllers\chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\FreightOffer;
use App\Models\TransportOffer;
use Illuminate\Http\Request;
use Session;

class chatController extends Controller
{
    public function chat(\Symfony\Component\HttpFoundation\Request $request)
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){
            $offer = FreightOffer::find(intval($request->offer));
            $offer->company = $offer->fk_shipper_id;
            $offer->announce = $offer->transportAnnounce;
            $offer->announce->origin = $offer->announce->originOffer;
            $offer->announce->destination = $offer->announce->destinationOffer;
            $offer->announce->company = $offer->announce->carrier;

            $chats = Chat::where('fk_offer_id','=', intval($request->offer))->orderBy('id','asc')->get();
            if (!empty($chats)){
                foreach ($chats as $chat){
                    $chat->user = $chat->user;
                    $chat->company =  $chat->user->fk_shipper_id;
                }
            }

        } elseif (Session::get('role') == env('ROLE_CARRIER')) {
            $offer = TransportOffer::find(intval($request->offer));
            $offer->company = $offer->fk_carrier_id;
            $offer->announce = $offer->freightAnnouncement;
            $offer->announce->origin = $offer->announce->originOffer;
            $offer->announce->destination = $offer->announce->destinationOffer;
            $offer->announce->company = $offer->announce->Shipper;

            $chats = Chat::where('fk_offer_id','=', intval($request->offer))->orderBy('id','asc')->get();
            if (!empty($chats)){
                foreach ($chats as $chat){
                    $chat->user = $chat->user;
                    $chat->company = $chat->user->fk_carrier_id;
                }
            }

        }
        return view('pages.chat.home', compact('offer','chats'));
    }


    public function chatInverse(\Symfony\Component\HttpFoundation\Request $request)
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $offer = TransportOffer::find(intval($request->offer));
            $offer->announce = $offer->freightAnnouncement;
            $offer->announce->origin = $offer->announce->originOffer;
            $offer->announce->destination = $offer->announce->destinationOffer;
            $offer->announce->company = $offer->announce->Shipper;

            $chats = Chat::where('fk_offer_id','=', intval($request->offer))->orderBy('id','asc')->get();
            if (!empty($chats)){
                foreach ($chats as $chat){
                    $chat->user = $chat->user;
                    $chat->company = $chat->user->fk_shipper_id;
                }
            }

        } elseif (Session::get('role') == env('ROLE_CARRIER')) {
            $offer = FreightOffer::find(intval($request->offer));
            $offer->announce = $offer->transportAnnounce;
            $offer->announce->origin = $offer->announce->originOffer;
            $offer->announce->destination = $offer->announce->destinationOffer;
            $offer->announce->company = $offer->announce->carrier;

            $chats = Chat::where('fk_offer_id','=', intval($request->offer))->orderBy('id','asc')->get();
            if (!empty($chats)){
                foreach ($chats as $chat){
                    $chat->user = $chat->user;
                    $chat->company = $chat->user->fk_carrier_id;
                }
            }
        }

        return view('pages.chat.home', compact('offer','chats'));
    }



    public function sendChat(\Symfony\Component\HttpFoundation\Request $request)
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){
            $chat =  new Chat();
            $chat->message = $request->message;
            $chat->fk_offer_id = $request->id;
            $chat->fk_user_id = intval( Session::get('userId') );

            $chat->save();

        } elseif (Session::get('role') == env('ROLE_CARRIER')) {
            $chat =  new Chat();
            $chat->message = $request->message;
            $chat->fk_offer_id = $request->id;
            $chat->fk_user_id = intval( Session::get('userId') );

            $chat->save();
        }
    }
}
