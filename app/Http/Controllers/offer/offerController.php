<?php

namespace App\Http\Controllers\offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\offer\applyForm;
use App\Http\Requests\offer\publishForm;
use App\Mail\offer\applyOfferDelete;
use App\Mail\offer\offerReceive;
use App\Mail\offer\offerSend;
use App\Mail\offer\publishOfferDelete;
use App\Mail\offer\publishOfferSend;
use App\Mail\offer\publishOfferUpdate;
use App\Models\Carrier;
use App\Models\ContractTransport;
use App\Models\FreightAnnouncement;
use App\Models\FreightOffer;
use App\Models\Shipper;
use App\Models\TransportAnnouncement;
use App\Models\TransportOffer;
use App\Models\TypeCar;
use App\Models\User;
use App\Models\Ville;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Session;

class offerController extends Controller
{
    //Count all announces
    public function countFreightAnnouncements()
    {
        return FreightAnnouncement::count();
    }

    public function getAllVille()
    {
        return Ville::all();
    }

    public function getAllTypeCar()
    {
        return TypeCar::all();
    }

    //Count all offer
    public function countFreightOffer()
    {
        return FreightOffer::count();
    }

    //Count all contract of transport
    public function ContractTransport()
    {
        return ContractTransport::count();
    }

    //Count all transport offers
    public function countTransportOffers()
    {
        return TransportOffer::count();
    }


    //Count all transport announce;ent
    public function countTransportAnnouncements()
    {
        return TransportAnnouncement::count(); // Compter les annonces
    }

    public function getOfferOne($id)
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $offer = FreightAnnouncement::find(intval($id));
            $offer->origin = $offer->originOffer;
            $offer->destination = $offer->destinationOffer;
        }
        elseif (Session::get('role') == env('ROLE_CARRIER')){

            $offer = TransportAnnouncement::find(intval($id));
            $offer->origin = $offer->originOffer;
            $offer->destination = $offer->destinationOffer;
            $offer->vehicule_type = $offer->vehiculeType;
        }
        return $offer;
    }

    public function getOfferApplyOne($id)
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $offer = FreightOffer::find(intval($id));
        }
        elseif (Session::get('role') == env('ROLE_CARRIER')){

            $offer = TransportOffer::find(intval($id));
        }
        return $offer;
    }

    public function getOfferPublishOne($id)
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $offer = TransportAnnouncement::find(intval($id));
            $offer->origin = $offer->originOffer;
            $offer->destination = $offer->destinationOffer;
            $offer->vehicule_type = $offer->vehiculeType;
        }
        elseif (Session::get('role') == env('ROLE_CARRIER')){

            $offer = FreightAnnouncement::find(intval($id));
            $offer->origin = $offer->originOffer;
            $offer->destination = $offer->destinationOffer;
        }
        return $offer;
    }

    public function home()
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            //Get the ten latest carrier offer
            $offers = DB::table('transport_announcement')
                ->selectRaw("transport_announcement.id, transport_announcement.origin, transport_announcement.destination, transport_announcement.limit_date,
                        transport_announcement.weight, transport_announcement.vehicule_type, transport_announcement.description,
                       carrier.company_name")
                ->join('carrier', 'transport_announcement.fk_carrier_id','=', 'carrier.id')
                ->where('limit_date', '>=', date("Y-m-d"))
                ->orderBy('transport_announcement.id', 'DESC')
                ->limit(10)
                ->get();
            $nbOffer = $this->countFreightAnnouncements();
            $nbOfferReceived = $this->countFreightOffer();

            return view('pages.home', compact('offers', 'nbOffer', 'nbOfferReceived'));

        }elseif (Session::get('role') == env('ROLE_CARRIER')){

            //Get the ten latest shipper offer
            $offers = DB::table('freight_announcement')
                ->selectRaw("
             freight_announcement.id,freight_announcement.origin,freight_announcement.destination,freight_announcement.limit_date,
             freight_announcement.weight, freight_announcement.volume,freight_announcement.description,
             shipper.company_name
             ")
                ->join('shipper','freight_announcement.fk_shipper_id' ,"=",'shipper.id')
                ->where('limit_date', '>=', date("Y-m-d"))
                ->orderBy('freight_announcement.id', 'DESC')
                ->limit(10)
                ->get();

            $nbContract = $this->ContractTransport();
            $nbOffer = $this->countTransportAnnouncements();
            $nbOfferReceived = $this->countTransportOffers();

            return view('pages.home', compact('offers', 'nbOffer', 'nbOfferReceived'));
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        }elseif (Session::get('role') == env('ROLE_ADMIN')){

            //Get the ten latest carrier offer
            $offersT = DB::table('transport_announcement')
                ->selectRaw("transport_announcement.id, transport_announcement.origin, transport_announcement.destination, transport_announcement.limit_date,
                        transport_announcement.weight, transport_announcement.vehicule_type, transport_announcement.description,
                       carrier.company_name")
                ->join('carrier', 'transport_announcement.fk_carrier_id','=', 'carrier.id')
                ->where('limit_date', '>=', date("Y-m-d"))
                ->orderBy('transport_announcement.id', 'DESC')
                ->limit(10)
                ->get();
            $nbOfferT = $this->countFreightAnnouncements();
            $nbOfferReceivedT = $this->countFreightOffer();

            //Get the ten latest shipper offer
            $offers = DB::table('freight_announcement')
                ->selectRaw("
             freight_announcement.id,freight_announcement.origin,freight_announcement.destination,freight_announcement.limit_date,
             freight_announcement.weight, freight_announcement.volume,freight_announcement.description,
             shipper.company_name
             ")
                ->join('shipper','freight_announcement.fk_shipper_id' ,"=",'shipper.id')
                ->where('limit_date', '>=', date("Y-m-d"))
                ->orderBy('freight_announcement.id', 'DESC')
                ->limit(10)
                ->get();

            $nbContract = $this->ContractTransport();
            $nbOffer = $this->countTransportAnnouncements();
            $nbOfferReceived = $this->countTransportOffers();

            return view('pages.admin.admin_home', compact('offersT', 'offers', 'nbOfferT', 'nbOffer', 'nbOfferReceivedT', 'nbOfferReceived'));


        }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    }

    public function storeApplyOffer(applyForm $request)
    {
        $validated = $request->validated();
        $user = User::find(intval(session('userId')));

        if (Session::get('role') == env('role_carrier')) {
            $offer = FreightAnnouncement::find(intval($request->offerId));
            $nameCarrier = Carrier::find(intval($user->fk_carrier_id));
            $nameShipper = Shipper::find($offer->fk_shipper_id);

            $shipperUsers = User::where([['fk_shipper_id', $offer->fk_shipper_id], ['status', env('DEFAULT_VALID')]])->get();
            $carrierUsers = User::where([['fk_carrier_id', $user->fk_carrier_id], ['status', env('DEFAULT_VALID')]])->get();

            //Add offer from shipper
            $applyOffer = new TransportOffer();
            $applyOffer->price = floatval($request->price);
            $applyOffer->description = $request->description;
            $applyOffer->fk_freight_announcement_id = intval($request->offerId);
            $applyOffer->fk_shipper_id = intval($user->fk_shipper_id);
            $applyOffer->status = env('default_int');
            $applyOffer->created_by = intval ($user->id);
            $applyOffer->save();

            //Get data to send email
            $data['price'] = $request->price;
            $data['description'] = $request->description;
            $data['offer'] = $offer;
            $data['receiver'] = $nameCarrier->company_name;
            $data['sender'] = $nameShipper->company_name;

            //Send mail
            foreach ($carrierUsers as $carrier){
                Mail::to($carrier->email)->send(new offerSend($data));

            }
            foreach ($shipperUsers as $shipper){
                Mail::to($shipper->email)->send(new offerReceive($data));
            }

        } elseif (Session::get('role') == env('role_shipper')) {
            $offer = TransportAnnouncement::find(intval($request->offerId));

            $nameCarrier = Carrier::find(intval($offer->fk_carrier_id));
            $nameShipper = Shipper::find($user->fk_shipper_id);

            $shipperUsers = User::where([['fk_shipper_id', $user->fk_shipper_id], ['status', env('DEFAULT_VALID')]])->get();
            $carrierUsers = User::where([['fk_carrier_id', $offer->fk_carrier_id], ['status', env('DEFAULT_VALID')]])->get();

            //Add offer from shipper
            $applyOffer = new FreightOffer();
            $applyOffer->price = floatval($request->price);
            $applyOffer->description = $request->description;
            $applyOffer->weight = floatval($request->weight);
            $applyOffer->fk_transport_announcement_id = intval($request->offerId);
            $applyOffer->fk_shipper_id = intval($user->fk_shipper_id);
            $applyOffer->status = env('default_int');
            $applyOffer->created_by = intval ($user->id);
            $applyOffer->save();

            //Get data to send email
            $data['price'] = $request->price;
            $data['description'] = $request->description;
            $data['offer'] = $offer;
            $data['receiver'] = $nameCarrier->company_name;
            $data['sender'] = $nameShipper->company_name;

            //Send mail
            foreach ($shipperUsers as $shipper){
               Mail::to($shipper->email)->send(new offerSend($data)) ;
            }

            foreach ($carrierUsers as $carrier){
                Mail::to($carrier->email)->send(new offerReceive($data));
            }
        }

        return redirect()->route('home')->with('success', "Offre ajoutée avec succès");
    }

    public function storePublishOffer(publishForm $request)
    {
        $data = $request->validated();
        $previousUrl  = app('router')->getRoutes(url()->previous())
                        ->match(app('request')->create(url()->previous()))->getName();
        if (Session::get('role') == env('ROLE_SHIPPER')){
            $shipperObject = Shipper::find(Session::get('fk_shipper_id'));

            $data['fk_shipper_id'] = Session::get('fk_shipper_id');
            $data['created_by'] = Session::get('userId');

            FreightAnnouncement::create($data);

            //Get data to send email
            $origin = Ville::find(intval($data['origin']));
            $destination = Ville::find(intval($data['destination']));
            $itemEmail = array(
                'origin'=>$origin->libelle,
                'destination'=>$destination->libelle,
                'name'=>$shipperObject->company_name,
                'description'=>$data['description'],
            );
            //Get all Carrier User
            $carriersUser = User::where([['fk_carrier_id', '!=', env('DEFAULT_INT')],['status', env('DEFAULT_VALID')]])->get();
            foreach ($carriersUser as $carrier){
                Mail::to($carrier->email)->send(new publishOfferSend($itemEmail));
            }

            return redirect()->route($previousUrl)->with('success', 'Offre publiée avec succès.');
        }elseif (Session::get('role') == env('role_carrier')){
            $carrierObject = Carrier::find(Session::get('fk_carrier_id'));

            $data['fk_carrier_id'] = Session::get('fk_carrier_id');
            $data['created_by'] = Session::get('userId');

            TransportAnnouncement::create($data);

            //Get data to send email
            $origin = Ville::find(intval($data['origin']));
            $destination = Ville::find(intval($data['destination']));
            $itemEmail = array(
                'origin'=>$origin->libelle,
                'destination'=>$destination->libelle,
                'name'=>$carrierObject->company_name,
                'description'=>$data['description'],
            );
            //Get all Shipper User
            $shippersUser = User::where([['fk_shipper_id', '!=', env('DEFAULT_INT')],['status', env('DEFAULT_VALID')]])->get();
            foreach ($shippersUser as $shipper){
                Mail::to($shipper->email)->send(new publishOfferSend($itemEmail));
            }

            return redirect()->route($previousUrl)->with('success', 'Offre publiée avec succès.');
        }
    }

    public function getOffers()
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            //Get the ten latest carrier offer
            $offers = DB::table('transport_announcement')
                ->selectRaw("transport_announcement.id, transport_announcement.origin, transport_announcement.destination, transport_announcement.limit_date,
                        transport_announcement.weight, transport_announcement.vehicule_type, transport_announcement.description,
                       carrier.company_name")
                ->join('carrier', 'transport_announcement.fk_carrier_id','=', 'carrier.id')
                ->where('limit_date', '>=', date("Y-m-d"))
                ->orderBy('transport_announcement.id', 'DESC')
                ->get();

            return view('pages.offer.home', compact('offers'));

        }elseif (Session::get('role') == env('ROLE_CARRIER')){

            //Get the ten latest shipper offer
            $offers = DB::table('freight_announcement')
                ->selectRaw("
             freight_announcement.id,freight_announcement.origin,freight_announcement.destination,freight_announcement.limit_date,
             freight_announcement.weight, freight_announcement.volume,freight_announcement.description,
             shipper.company_name
             ")
                ->join('shipper','freight_announcement.fk_shipper_id' ,"=",'shipper.id')
                ->where('limit_date', '>=', date("Y-m-d"))
                ->orderBy('freight_announcement.id', 'DESC')
                ->get();

            return view('pages.offer.home', compact('offers'));

        }
    }

    public function getOffersReceived()
    {
        $offers = [];

        if (Session::get('role') == env('ROLE_SHIPPER')){
            $user = User::find(session()->get('userId'));
            $dataOffers = FreightAnnouncement::where('fk_shipper_id', intval($user->fk_shipper_id))
                ->orderBy('created_at', 'DESC')
                ->get();

            // Add detail to offer
            $cptOffer =0;
            $dataOffers->each(function ($offer) {
                $offer->offerCount = $offer->transportOffer;
                $offer->origin = $offer->originOffer;
                $offer->destination = $offer->destinationOffer;

                $offer->offerColor = "primary";
                if (count($offer->offerCount ) != env('DEFAULT_INT')){
                    $cptOffer = count($offer->offerCount);
                    $offer->offerCount = $cptOffer;
                    $offer->offerColor = "info";
                }
            });

            foreach($dataOffers as $offer){
                if ($offer->offerCount != env('DEFAULT_INT')){
                    array_push($offers, $offer);
                }
            }

            return view('pages.offer.offerReceived', compact('offers'));

        }elseif( Session::get('role') == env('ROLE_CARRIER')){
            $user = User::find(session()->get('userId'));
            $dataOffers = TransportAnnouncement::where('fk_carrier_id', intval($user->fk_carrier_id))
                ->orderBy('created_at', 'DESC')
                ->get();

            // Add detail to offer
            $cptOffer =0;
            $dataOffers->each(function ($offer) {
                $offer->offerCount = $offer->transportOffer;
                $offer->origin = $offer->originOffer;
                $offer->destination = $offer->destinationOffer;

                $offer->offerColor = "primary";
                if (count($offer->offerCount ) != env('DEFAULT_INT')){
                    $cptOffer = count($offer->offerCount);
                    $offer->offerCount = $cptOffer;
                    $offer->offerColor = "info";
                }
            });

            foreach($dataOffers as $offer){
                if ($offer->offerCount != env('DEFAULT_INT')){
                    array_push($offers, $offer);
                }
            }

            return view('pages.offer.offerReceived', compact('offers'));
        }
    }

    public function getOffersNotReceived()
    {
        $offers = [];
        if (Session::get('role') == env('ROLE_SHIPPER')){
            $user = User::find(session()->get('userId'));
            $dataOffers = FreightAnnouncement::where('fk_shipper_id', intval($user->fk_shipper_id))
                ->orderBy('created_at', 'DESC')
                ->get();

            // Add detail to offer
            $dataOffers->each(function ($offer) {
                $offer->offerCount = $offer->transportOffer;
                $offer->origin = $offer->originOffer;
                $offer->destination = $offer->destinationOffer;

                if (count($offer->offerCount ) == env('DEFAULT_INT')){
                    $offer->offerCount = intval(env('DEFAULT_INT'));
                }
            });

            foreach($dataOffers as $offer){
                if ($offer->offerCount == env('DEFAULT_INT')){
                    array_push($offers, $offer);
                }
            }

            return view('pages.offer.offerNotReceived', compact('offers'));

        }elseif( Session::get('role') == env('ROLE_CARRIER')){
            $user = User::find(session()->get('userId'));
            $dataOffers = TransportAnnouncement::where('fk_carrier_id', intval($user->fk_carrier_id))
                ->orderBy('created_at', 'DESC')
                ->get();

            // Add detail to offer
            $dataOffers->each(function ($offer) {
                $offer->offerCount = $offer->freightOffer;
                $offer->origin = $offer->originOffer;
                $offer->destination = $offer->destinationOffer;

                if (count($offer->offerCount ) == env('DEFAULT_INT')){
                    $offer->offerCount = intval(env('DEFAULT_INT'));
                }
            });

            foreach($dataOffers as $offer){
                if ($offer->offerCount == env('DEFAULT_INT')){
                    array_push($offers, $offer);
                }
            }

            return view('pages.offer.offerNotReceived', compact('offers'));
        }
    }

    public function updatePublishOffer(publishForm $request)
    {
        $data = $request->validated();
        $previousUrl  = app('router')->getRoutes(url()->previous())
            ->match(app('request')->create(url()->previous()))->getName();
        if (Session::get('role') == env('ROLE_SHIPPER')){
            $shipperObject = Shipper::find(Session::get('fk_shipper_id'));

            $offer = FreightAnnouncement::find(intval($request->idOffer));
            if($offer->fk_shipper_id == Session::get('fk_shipper_id')){

                $offer->origin = $data['origin'];
                $offer->destination = $data['destination'];
                $offer->weight = $data['weight'];
                $offer->price = $data['price'];
                $offer->volume = $data['volume'];
                $offer->limit_date = $data['limit_date'];
                $offer->description = $data['description'];
                $offer->created_by = Session::get('userId');
                $offer->updated_at = date("Y-m-d H:i:s");

                $offer->save();
            }else{
                return redirect()->route($previousUrl)->with('danger', 'Vous n\êtes pas autorisé à modifier .');
            }

            //Get data to send email
            $origin = Ville::find(intval($data['origin']));
            $destination = Ville::find(intval($data['destination']));
            $itemEmail = array(
                'origin'=>$origin->libelle,
                'destination'=>$destination->libelle,
                'name'=>$shipperObject->company_name,
                'description'=>$data['description'],
            );
            //Get all Carrier User
            $carriersUser = User::where([['fk_carrier_id', '!=', env('DEFAULT_INT')],['status', env('DEFAULT_VALID')]])->get();
            foreach ($carriersUser as $carrier){
                Mail::to($carrier->email)->send(new publishOfferSend($itemEmail));
            }

            return redirect()->route($previousUrl)->with('success', 'Offre modifiée avec succès.');
        }elseif (Session::get('role') == env('role_carrier')){

            $carrierObject = Carrier::find(Session::get('fk_carrier_id'));

            $offer = TransportAnnouncement::find(intval($request->idOffer));
            if($offer->fk_carrier_id == Session::get('fk_shipper_id')){

                $offer->origin = $data['origin'];
                $offer->destination = $data['destination'];
                $offer->weight = $data['weight'];
                $offer->vehicule_type = $data['vehicule_type'];
                $offer->limit_date = $data['limit_date'];
                $offer->description = $data['description'];
                $offer->created_by = Session::get('userId');
                $offer->updated_at = date("Y-m-d H:i:s");

                $offer->save();
            }else{
                return redirect()->route($previousUrl)->with('danger', 'Vous n\êtes pas autorisé à modifier .');
            }

            //Get data to send email
            $origin = Ville::find(intval($data['origin']));
            $destination = Ville::find(intval($data['destination']));
            $itemEmail = array(
                'origin'=>$origin->libelle,
                'destination'=>$destination->libelle,
                'name'=>$carrierObject->company_name,
                'description'=>$data['description'],
            );
            //Get all Shipper User
            $shippersUser = User::where([['fk_shipper_id', '!=', env('DEFAULT_INT')],['status', env('DEFAULT_VALID')]])->get();
            foreach ($shippersUser as $shipper){
                Mail::to($shipper->email)->send(new publishOfferUpdate($itemEmail));
            }

            return redirect()->route($previousUrl)->with('success', 'Offre modifiée avec succès.');
        }
    }

    public function deletePublishOffer($id)
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $offer = FreightAnnouncement::find( intval($id) );
            //Get all Shipper User
            $shippersUser = User::where([['fk_shipper_id', '=', Session::get('fk_shipper_id')],['status', env('DEFAULT_VALID')]])->get();
            $data = array(
                'name' => Session::get('first_name').' '.Session::get('first_name'),
                'description' => $offer->description,
                'origine' => $offer->originOffer->libelle,
                'destination' => $offer->destinationOffer->libelle,
            );
            foreach ($shippersUser as $shipper){
                Mail::to($shipper->email)->send(new publishOfferDelete($data));
            }
            if ( Session::get('fk_shipper_id') == $offer->fk_shipper_id ){

                $offer->delete();
                return 0 ;
            }else{
                return 1 ;
            }
        }elseif (Session::get('role') == env('ROLE_CARRIER')){

            $offer = TransportAnnouncement::find( intval($id) );
            //Get all Carrier User
            $carriersUser = User::where([['fk_carrier_id', '=', Session::get('fk_carrier_id')],['status', env('DEFAULT_VALID')]])->get();
            $data = array(
                'name' => Session::get('first_name').' '.Session::get('first_name'),
                'description' => $offer->description,
                'origine' => $offer->originOffer->libelle,
                'destination' => $offer->destinationOffer->libelle,
            );
            foreach ($carriersUser as $carrier){
                Mail::to($carrier->email)->send(new publishOfferDelete($data));
            }
            if ( Session::get('fk_carrier_id') == $offer->fk_carrier_id ){

                $offer->delete();
                return 0 ;
            }else{
                return 1 ;
            }
        }

    }

    public function getOffersApply()
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $offers =FreightOffer::where('fk_shipper_id', Session::get('fk_shipper_id'))->get();

            $offers->each(function ($offer){

                $offer->announce = $offer->transportAnnounce;
                $offer->offer = $offer->fk_transport_announcement_id;
                if($offer->status == env('DEFAULT_INT')){
                    $offer->statusMsg ="En attente";
                    $offer->statusBtn ="info";
                }elseif ($offer->status == env('DEFAULT_VALID')){
                    $offer->statusMsg ="Refusé";
                    $offer->statusBtn ="danger";
                }elseif($offer->status == env('STATUS_VALID')){
                    $offer->statusMsg ="Accepté";
                    $offer->statusBtn ="success";
                }
            });

        }elseif(Session::get('role') == env('ROLE_CARRIER')){

            $offers =TransportOffer::where('fk_carrier_id', Session::get('fk_carrier_id'))->get();

            $offers->each(function ($offer){
                $offer->announce = $offer->freightAnnouncement;
                $offer->offer = $offer->fk_freight_announcement_id;
                if($offer->status == env('DEFAULT_INT')){
                    $offer->statusMsg ="En attente";
                    $offer->statusBtn ="info";
                }elseif ($offer->status == env('DEFAULT_VALID')){
                    $offer->statusMsg ="Refusé";
                    $offer->statusBtn ="danger";
                }elseif($offer->status == env('STATUS_VALID')){
                    $offer->statusMsg ="Accepté";
                    $offer->statusBtn ="success";
                }
            });
        }

        return view('pages.offer.offerApply', compact('offers'));
    }


    public function deleteApplyOffer($id)
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $offer = FreightOffer::find( intval($id) );
            $carrier_fk = $offer->transportAnnounce->fk_carrier_id;
            //Get all Shipper User
            $shippersUser = User::where([['fk_shipper_id', '=', Session::get('fk_shipper_id')],['status', env('DEFAULT_VALID')]])->get();
            $carriersUser = User::where([['fk_carrier_id', '=', $carrier_fk],['status', env('DEFAULT_VALID')]])->get();
            $data = array(
                'name' => Session::get('first_name').' '.Session::get('first_name'),
                'description' => $offer->description,
                'prix' => $offer->price
            );
            foreach ($shippersUser as $shipper){
                Mail::to($shipper->email)->send(new applyOfferDelete($data));
            }

            foreach ($carriersUser as $carrier){
                Mail::to($carrier->email)->send(new applyOfferDelete($data));
            }
            if ( Session::get('fk_shipper_id') == $offer->fk_shipper_id ){

                $offer->delete();
                return 0 ;
            }else{
                return 1 ;
            }
        }elseif (Session::get('role') == env('ROLE_CARRIER')){

            $offer = TransportOffer::find( intval($id) );
            $shipper_fk = $offer->freightAnnouncement->fk_shipper_id;
            //Get all Shipper User
             $carriersUser = User::where([['fk_carrier_id', '=', Session::get('fk_carrier_id')],['status', env('DEFAULT_VALID')]])->get();
             $shippersUser = User::where([['fk_shipper_id', '=', $shipper_fk],['status', env('DEFAULT_VALID')]])->get();
            $data = array(
                'name' => Session::get('first_name').' '.Session::get('first_name'),
                'description' => $offer->description,
                'prix' => $offer->price
            );
            foreach ($shippersUser as $shipper){
                Mail::to($shipper->email)->send(new applyOfferDelete($data));
            }

            foreach ($carriersUser as $carrier){
                Mail::to($carrier->email)->send(new applyOfferDelete($data));
            }
            if ( Session::get('fk_carrier_id') == $offer->fk_carrier_id ){

                $offer->delete();
                return 0 ;
            }else{
                return 1 ;
            }
        }
    }

    public function updateApplyOffer(applyForm $request)
    {
        $validated = $request->validated();
        $user = User::find(intval(session('userId')));

        if (Session::get('role') == env('role_carrier')) {

            $offer = FreightOffer::find(intval($request->offerId));

            $offer->price = floatval($request->price);
            $offer->description = $request->description;
            $offer->updated_at = date("Y-m-d H:i:s");
            $nameCarrier = Carrier::find(intval($user->fk_carrier_id));
            $nameShipper = Shipper::find($offer->fk_shipper_id);

            $shipperUsers = User::where([['fk_shipper_id', $offer->fk_shipper_id], ['status', env('DEFAULT_VALID')]])->get();
            $carrierUsers = User::where([['fk_carrier_id', $user->fk_carrier_id], ['status', env('DEFAULT_VALID')]])->get();

            //Add offer from shipper
            $applyOffer = new TransportOffer();
            $applyOffer->price = floatval($request->price);
            $applyOffer->description = $request->description;
            $applyOffer->fk_freight_announcement_id = intval($request->offerId);
            $applyOffer->fk_shipper_id = intval($user->fk_shipper_id);
            $applyOffer->status = env('default_int');
            $applyOffer->created_by = intval ($user->id);
            $applyOffer->save();

            //Get data to send email
            $data['price'] = $request->price;
            $data['description'] = $request->description;
            $data['offer'] = $offer;
            $data['receiver'] = $nameCarrier->company_name;
            $data['sender'] = $nameShipper->company_name;

            //Send mail
            foreach ($carrierUsers as $carrier){
                Mail::to($carrier->email)->send(new offerSend($data));

            }
            foreach ($shipperUsers as $shipper){
                Mail::to($shipper->email)->send(new offerReceive($data));
            }

        } elseif (Session::get('role') == env('role_shipper')) {
            $offer = TransportAnnouncement::find(intval($request->offerId));

            $nameCarrier = Carrier::find(intval($offer->fk_carrier_id));
            $nameShipper = Shipper::find($user->fk_shipper_id);

            $shipperUsers = User::where([['fk_shipper_id', $user->fk_shipper_id], ['status', env('DEFAULT_VALID')]])->get();
            $carrierUsers = User::where([['fk_carrier_id', $offer->fk_carrier_id], ['status', env('DEFAULT_VALID')]])->get();

            //Add offer from shipper
            $applyOffer = new FreightOffer();
            $applyOffer->price = floatval($request->price);
            $applyOffer->description = $request->description;
            $applyOffer->weight = floatval($request->weight);
            $applyOffer->fk_transport_announcement_id = intval($request->offerId);
            $applyOffer->fk_shipper_id = intval($user->fk_shipper_id);
            $applyOffer->status = env('default_int');
            $applyOffer->created_by = intval ($user->id);
            $applyOffer->save();

            //Get data to send email
            $data['price'] = $request->price;
            $data['description'] = $request->description;
            $data['offer'] = $offer;
            $data['receiver'] = $nameCarrier->company_name;
            $data['sender'] = $nameShipper->company_name;

            //Send mail
            foreach ($shipperUsers as $shipper){
                Mail::to($shipper->email)->send(new offerSend($data)) ;
            }

            foreach ($carrierUsers as $carrier){
                Mail::to($carrier->email)->send(new offerReceive($data));
            }
        }

        return redirect()->route('home')->with('success', "Offre ajoutée avec succès");
    }

    public function chat()
    {
        return view('pages.chat.home');

    }


}
