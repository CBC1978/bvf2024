<?php

namespace App\Http\Controllers\offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\car\form;
use App\Http\Requests\offer\applyForm;
use App\Http\Requests\offer\publishForm;
use App\Mail\offer\applyOfferDelete;
use App\Mail\offer\offerApplyResponse;
use App\Mail\offer\offerReceive;
use App\Mail\offer\offerSend;
use App\Mail\offer\publishOfferDelete;
use App\Mail\offer\publishOfferSend;
use App\Mail\offer\publishOfferUpdate;
use App\Models\BrandCar;
use App\Models\Car;
use App\Models\Carrier;
use App\Models\Chat;
use App\Models\ContractDetails;
use App\Models\ContractTransport;
use App\Models\Driver;
use App\Models\FreightAnnouncement;
use App\Models\FreightOffer;
use App\Models\Shipper;
use App\Models\TransportAnnouncement;
use App\Models\TransportOffer;
use App\Models\TypeCar;
use App\Models\User;
use App\Models\Ville;
use Symfony\Component\HttpFoundation\Request;
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

    public function getCarByCarrier()
    {
        $cars = Car::where('fk_carrier_id','=',Session::get('fk_carrier_id'))->get();
        if(!empty($cars)){
            $cars->each(function ($car){
                $car->type = $car->type;
                $car->brand = $car->brand;
            });
        }

        return $cars;
    }

    public function getAllTypeCar()
    {
        return TypeCar::all();
    }

    public function getAllBrandCar()
    {
        return BrandCar::all();
    }

    //Count all offer
    public function countFreightOffer()
    {
        return FreightOffer::count();
    }

    //Count all contract of transport
    public function ContractTransport()
    {
        $year = date('Y');
        $debut = '01-01-'.$year;
        $fin = '31-12-'.$year;
        if (Session::get('role') == env('ROLE_CARRIER')) {
            $contratc = DB::table('contract_transport')
                ->selectRaw("
                    contract_transport.id,
                    transport_announcement.origin,
                    transport_announcement.destination,
                    transport_announcement.description,
                    transport_announcement.weight
                    ")
                ->join('freight_offer', 'contract_transport.fk_freight_offert_id', '=', 'freight_offer.id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id', '=', 'transport_announcement.id')
                ->where('freight_offer.status', env('status_valid'))
                ->whereBetween('contract_transport.created_at', [$debut, $fin])
                ->where('transport_announcement.fk_carrier_id', Session::get('fk_carrier_id'))
                ->orderBy('contract_transport.id','desc')
                ->get();

            $contrats = DB::table('contract_transport')
                ->selectRaw("
                    contract_transport.id,
                    freight_announcement.origin,
                    freight_announcement.destination,
                    freight_announcement.description,
                    freight_announcement.weight
                    ")
                ->join('transport_offer', 'contract_transport.fk_transport_offer_id', '=', 'transport_offer.id')
                ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id', '=', 'freight_announcement.id')
                ->where('transport_offer.status',  env('status_valid'))
                ->whereBetween('contract_transport.created_at', [$debut, $fin])
                ->where('transport_offer.fk_carrier_id', Session::get('fk_carrier_id'))
                ->orderBy('contract_transport.id','desc')
                ->get();
            return (count($contrats) + count($contratc));
        }elseif(Session::get('role') == env('ROLE_SHIPPER')){
            $contrats = DB::table('contract_transport')
                ->selectRaw("
                        contract_transport.id,
                        freight_announcement.origin,
                        freight_announcement.destination,
                        freight_announcement.description,
                        freight_announcement.weight
                        ")
                ->join('transport_offer', 'contract_transport.fk_transport_offer_id', '=', 'transport_offer.id')
                ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id', '=', 'freight_announcement.id')
                ->where('transport_offer.status', env('STATUS_VALID'))
                ->whereBetween('contract_transport.created_at', [$debut, $fin])
                ->where('freight_announcement.fk_shipper_id', Session::get('fk_shipper_id'))
                ->orderBy('contract_transport.id', 'desc')
                ->get();

            $contratc = DB::table('contract_transport')
                ->selectRaw("
                        contract_transport.id,
                        transport_announcement.origin,
                        transport_announcement.destination,
                        transport_announcement.description,
                        transport_announcement.weight
                        ")
                ->join('freight_offer', 'contract_transport.fk_freight_offert_id', '=', 'freight_offer.id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id', '=', 'transport_announcement.id')
                ->where('freight_offer.status', env('STATUS_VALID'))
                ->whereBetween('contract_transport.created_at', [$debut, $fin])
                ->where('freight_offer.fk_shipper_id', Session::get('fk_shipper_id'))
                ->where('contract_transport', Session::get('fk_shipper_id'))
                ->orderBy('contract_transport.id', 'desc')
                ->get();
            return (count($contrats) + count($contratc));
        }

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
            $offers->each(function ($offer){
                $offer->origin = Ville::find(intval($offer->origin));
                $offer->destination = Ville::find(intval($offer->destination));
            });
            $nbOffer = $this->countFreightAnnouncements();
            $nbOfferReceived = $this->countFreightOffer();

            $nbContract = 0;
//                $this->ContractTransport();

            return view('pages.home', compact('offers', 'nbOffer', 'nbOfferReceived','nbContract'));

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
            $offers->each(function ($offer){
                $offer->origin = Ville::find(intval($offer->origin));
                $offer->destination = Ville::find(intval($offer->destination));
            });
            $nbContract = 0;
//                $this->ContractTransport();
            $nbOffer = $this->countTransportAnnouncements();
            $nbOfferReceived = $this->countTransportOffers();

            return view('pages.home', compact('offers', 'nbOffer', 'nbOfferReceived','nbContract'));
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
            $applyOffer->fk_carrier_id = intval(session('fk_carrier_id'));
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

        return redirect()->route('home')->with('success', "Proposition ajoutée avec succès");
    }

    public function storePublishOffer(publishForm $request)
    {
       $request->validated();
        $previousUrl  = app('router')->getRoutes(url()->previous())
            ->match(app('request')->create(url()->previous()))->getName();
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $obj = new FreightAnnouncement();
            $obj->origin = intval($request->origin);
            $obj->destination = intval($request->destination);
            $obj->limit_date = $request->limit_date;
            $obj->weight = $request->weight;
            $obj->volume = $request->volume;
            $obj->price = $request->price;
            $obj->description = $request->description;
            $obj->created_by = Session::get('userId');
            $obj->status = env('DEFAULT_INT');
            $obj->fk_shipper_id = Session::get('fk_shipper_id');

            $obj->save();

            //Get data to send email
            $origin = Ville::find(intval($request->origin));
            $destination = Ville::find(intval($request->destination));
            $shipperObject = Shipper::find(Session::get('fk_shipper_id'));
            $itemEmail = array(
                'origin'=>$origin->libelle,
                'destination'=>$destination->libelle,
                'name'=>$shipperObject->company_name,
                'description'=>$request->description,
            );
            //Get all Carrier User
            $carriersUser = User::where([['fk_carrier_id', '!=', env('DEFAULT_INT')],['status', env('DEFAULT_VALID')]])->get();
            foreach ($carriersUser as $carrier){
                Mail::to($carrier->email)->send(new publishOfferSend($itemEmail));
            }

            return redirect()->route($previousUrl)->with('success', 'Offre publiée avec succès.');

        }elseif (Session::get('role') == env('role_carrier')){

            $obj = new TransportAnnouncement();
            $obj->origin = intval($request->origin);
            $obj->destination = intval($request->destination);
            $obj->limit_date = $request->limit_date;
            $obj->weight = $request->weight;
            $obj->vehicule_type = $request->vehicule_type;
            $obj->created_by = Session::get('userId');
            $obj->description = $request->description;
            $obj->status = env('DEFAULT_INT');
            $obj->fk_carrier_id = Session::get('fk_carrier_id');

            $obj->save();

            //Get data to send email
            $origin = Ville::find(intval($request->origin));
            $destination = Ville::find(intval($request->destination));
            $carrierObject = Carrier::find(Session::get('fk_carrier_id'));
            $itemEmail = array(
                'origin'=>$origin->libelle,
                'destination'=>$destination->libelle,
                'name'=>$carrierObject->company_name,
                'description'=>$request->description
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
                ->selectRaw("
                    transport_announcement.id,
                    transport_announcement.origin,
                    transport_announcement.destination,
                    transport_announcement.limit_date,
                    transport_announcement.weight,
                    transport_announcement.vehicule_type,
                    transport_announcement.description,
                   carrier.company_name")
                ->join('carrier', 'transport_announcement.fk_carrier_id','=', 'carrier.id')
                ->where('limit_date', '>=', date("Y-m-d"))
                ->orderBy('transport_announcement.id', 'DESC')
                ->get();
            $offers->each(function ($obj){
                $obj->origin = Ville::find(intval($obj->origin));
                $obj->destination = Ville::find(intval($obj->destination));

            });

            return view('pages.offer.home', compact('offers'));

        }elseif (Session::get('role') == env('ROLE_CARRIER')){

            //Get the ten latest shipper offer
            $offers = DB::table('freight_announcement')
                ->selectRaw("
                    freight_announcement.id,
                    freight_announcement.origin,
                    freight_announcement.destination,
                    freight_announcement.limit_date,
                    freight_announcement.weight,
                    freight_announcement.volume,
                    freight_announcement.description,
                    shipper.company_name
                    ")
                ->join('shipper','freight_announcement.fk_shipper_id' ,"=",'shipper.id')
                ->where('limit_date', '>=', date("Y-m-d"))
                ->orderBy('freight_announcement.id', 'DESC')
                ->get();
            $offers->each(function ($obj){
                $obj->origin = Ville::find(intval($obj->origin));
                $obj->destination = Ville::find(intval($obj->destination));
            });

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
                }else{
                    $offer->offerCount = env('DEFAULT_INT');
                    $offer->offerColor = "primary";
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
                $offer->offerCount = $offer->freightOffer;
                $offer->origin = $offer->originOffer;
                $offer->destination = $offer->destinationOffer;

                $offer->offerColor = "primary";
                if (count($offer->offerCount ) != env('DEFAULT_INT')){
                    $cptOffer = count($offer->offerCount);
                    $offer->offerCount = $cptOffer;
                    $offer->offerColor = "info";
                }
                else{
                    $offer->offerCount = env('DEFAULT_INT');
                    $offer->offerColor = "primary";
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

    public function getOffersReceivedDetail($id)
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $offer = FreightAnnouncement::find(intval($id));
            $offer->offers = $offer->transportOffer;

            $offer->offers->each(function($offer){
                $offer->company = $offer->carrier->company_name;
                if ($offer->status == env('DEFAULT_INT'))
                    $offer->color = 'info';
                elseif ($offer->status == env('STATUS_VALID'))
                    $offer->color = 'success';
                elseif ($offer->status == env('DEFAULT_VALID'))
                    $offer->color = 'danger';
            });
            $offer->origin = $offer->originOffer;
            $offer->destination = $offer->destinationOffer;
            $offer->company = $offer->Shipper->company_name;

        }elseif(Session::get('role') == env('ROLE_CARRIER')){

            $offer = TransportAnnouncement::find(intval($id));
            $offer->offers = $offer->freightOffer;

            $offer->offers->each(function($of){
                $of->company = $of->Shipper->company_name;
                if ($of->status == env('DEFAULT_INT'))
                    $of->color = 'info';
                elseif ($of->status == env('STATUS_VALID'))
                    $of->color = 'success';
                elseif ($of->status == env('DEFAULT_VALID'))
                    $of->color = 'danger';
            });
            $offer->origin = $offer->originOffer;
            $offer->destination = $offer->destinationOffer;
            $offer->company = $offer->carrier->company_name;
            $offer->vehicule_type = $offer->vehiculeType;
        }
        return view('pages.offer.offerReceivedDetail', compact('offer'));
    }


    public function updateStatutOffer($id,$action)
    {
        if (Session::get('role') == env('ROLE_CARRIER')){
            $offer = FreightOffer::find(intval($id));
            //Get users to send email
            $tsp = $offer->transportAnnounce;
            $carrier = $tsp->carrier;
            $userCarrier = $carrier->users;
            $shipper = $offer->Shipper;
            $userShipper = $shipper->users;

            //Message to send email Shipper
            $dataEmail = array(
                'objet'=>'Proposition de fret pour l\'offre de transport',
                'response'=>'acceptée',
                'price'=>$offer->price,
                'description'=>$offer->description,
                'offer'=>$tsp,
                'receiver'=>$shipper->company_name,
            );

            //Message to send email Carrier
            $dataEmailCarrier = array(
                'objet'=>'Vous avez accepté la proposition cette offre de fret',
                'response'=>'acceptée',
                'price'=>$offer->price,
                'description'=>$offer->description,
                'offer'=>$tsp,
                'receiver'=>$shipper->company_name,
            );

            //Message to send email Shipper
            $dataEmailRefuser = array(
                'objet'=>'Proposition de fret pour l\'offre de transport',
                'response'=>'réfusée',
                'price'=>$offer->price,
                'description'=>$offer->description,
                'offer'=>$tsp,
                'receiver'=>$shipper->company_name,
            );

            //Message to send email Carrier
            $dataEmailCarrierRefuser = array(
                'objet'=>'Vous avez réfusé la proposition cette offre de fret',
                'response'=>'réfusée',
                'price'=>$offer->price,
                'description'=>$offer->description,
                'offer'=>$tsp,
                'receiver'=>$shipper->company_name,
            );

            $contrat = ContractTransport::where('fk_freight_offert_id','=',intval($id))->get();

            if (intval($action) == env('STATUS_VALID')){
                $offer->status = env('STATUS_VALID');

                if(!empty($contrat) && count($contrat)== env('STATUS_VALID')){

                }elseif(!empty($contrat) && count($contrat) > env('STATUS_VALID')){
                    foreach ($contrat as $ct){
                        $ct->delete();
                    }
                    $contrat =new ContractTransport();
                    $contrat->created_by = intval(Session::get("userId"));
                    $contrat->fk_freight_offert_id = intval($id);
                    $contrat->fk_transport_offer_id =  env('DEFAULT_INT');
                    $contrat->save();
                    foreach ($userShipper as $ship){
                        if($ship->status >= env('STATUS_VALID')){
                            Mail::to($ship->email)->send(new offerApplyResponse($dataEmail));
                        }
                    }

                    foreach ($userCarrier as $carrier){
                        if($carrier->status >= env('STATUS_VALID')){
                            Mail::to($carrier->email)->send(new offerApplyResponse($dataEmailCarrier));
                        }
                    }
                }
                else{
                    $contrat =new ContractTransport();
                    $contrat->created_by = intval(Session::get("userId"));
                    $contrat->fk_freight_offert_id = intval($id);
                    $contrat->fk_transport_offer_id =  env('DEFAULT_INT');
                    $contrat->save();

                    foreach ($userShipper as $ship){
                        if($ship->status >= env('STATUS_VALID')){
                            Mail::to($ship->email)->send(new offerApplyResponse($dataEmail));
                        }
                    }
                    foreach ($userCarrier as $carrier){
                        if($carrier->status >= env('STATUS_VALID')){
                            Mail::to($carrier->email)->send(new offerApplyResponse($dataEmailCarrier));
                        }
                    }
                }
            }

            if (intval($action) == env('DEFAULT_VALID')){
                $offer->status = env('DEFAULT_VALID');
                if(!empty($contrat)){
                    foreach ($contrat as $ct){
                        $ct->delete();
                    }
                }
                foreach ($userShipper as $ship){
                    if($ship->status >= env('STATUS_VALID')){
                        Mail::to($ship->email)->send(new offerApplyResponse($dataEmailRefuser));
                    }
                }
                foreach ($userCarrier as $carrier){
                    if($carrier->status >= env('STATUS_VALID')){
                        Mail::to($carrier->email)->send(new offerApplyResponse($dataEmailCarrierRefuser));
                    }
                }

            }
            $offer->save();
            return response()->json('0');

        }elseif (Session::get('role') == env('ROLE_SHIPPER')){

            $offer = TransportOffer::find(intval($id));
            //Get users to send email
            $tsp = $offer->freightAnnouncement;
            $carrier = $offer->Carrier;
            $userCarrier = $carrier->users;
            $shipper = $tsp->Shipper;
            $userShipper = $shipper->users;

            //Message to send email Shipper
            $dataEmail = array(
                'objet'=>'Proposition de fret pour l\'offre de transport',
                'response'=>'acceptée',
                'price'=>$offer->price,
                'description'=>$offer->description,
                'offer'=>$tsp,
                'receiver'=>$shipper->company_name,
            );

            //Message to send email Carrier
            $dataEmailShipper = array(
                'objet'=>'Vous avez accepté la proposition cette offre de fret',
                'response'=>'acceptée',
                'price'=>$offer->price,
                'description'=>$offer->description,
                'offer'=>$tsp,
                'receiver'=>$shipper->company_name,
            );

            //Message to send email Shipper
            $dataEmailRefuser = array(
                'objet'=>'Proposition de fret pour l\'offre de transport',
                'response'=>'réfusée',
                'price'=>$offer->price,
                'description'=>$offer->description,
                'offer'=>$tsp,
                'receiver'=>$shipper->company_name,
            );

            //Message to send email Carrier
            $dataEmailShipperRefuser = array(
                'objet'=>'Vous avez réfusé la proposition cette offre de fret',
                'response'=>'réfusée',
                'price'=>$offer->price,
                'description'=>$offer->description,
                'offer'=>$tsp,
                'receiver'=>$shipper->company_name,
            );
            $contrat = ContractTransport::where('fk_transport_offer_id','=',intval($id))->get();
            if (intval($action) == env('STATUS_VALID')){
                $offer->status = env('STATUS_VALID');
                if(!empty($contrat) && count($contrat)== env('STATUS_VALID')){

                }elseif(!empty($contrat) && count($contrat) > env('STATUS_VALID')){
                    foreach ($contrat as $ct){
                        $ct->delete();
                    }
                    $contrat =new ContractTransport();
                    $contrat->created_by = intval(Session::get("userId"));
                    $contrat->fk_freight_offert_id = env('DEFAULT_INT');
                    $contrat->fk_transport_offer_id = intval($id);
                    $contrat->save();

                    foreach ($userShipper as $ship){
                        if($ship->status >= env('STATUS_VALID')){
                            Mail::to($ship->email)->send(new offerApplyResponse($dataEmailShipper));
                        }
                    }
                    foreach ($userCarrier as $carrier){
                        if($carrier->status >= env('STATUS_VALID')){
                            Mail::to($carrier->email)->send(new offerApplyResponse($dataEmail));
                        }
                    }
                }
                else{
                    $contrat =new ContractTransport();
                    $contrat->created_by = intval(Session::get("userId"));
                    $contrat->fk_freight_offert_id = env('DEFAULT_INT');
                    $contrat->fk_transport_offer_id = intval($id);
                    $contrat->save();

                    foreach ($userShipper as $ship){
                        if($ship->status >= env('STATUS_VALID')){
                            Mail::to($ship->email)->send(new offerApplyResponse($dataEmailShipper));
                        }
                    }
                    foreach ($userCarrier as $carrier){
                        if($carrier->status >= env('STATUS_VALID')){
                            Mail::to($carrier->email)->send(new offerApplyResponse($dataEmail));
                        }
                    }
                }
            }
            if (intval($action) == env('DEFAULT_VALID')){
                $offer->status = env('DEFAULT_VALID');
                if(!empty($contrat)){
                    foreach ($contrat as $ct){
                        $ct->delete();
                    }
                }
                foreach ($userShipper as $ship){
                    if($ship->status >= env('STATUS_VALID')){
                        Mail::to($ship->email)->send(new offerApplyResponse($dataEmailShipperRefuser));
                    }
                }
                foreach ($userCarrier as $carrier){
                    if($carrier->status >= env('STATUS_VALID')){
                        Mail::to($carrier->email)->send(new offerApplyResponse($dataEmailRefuser));
                    }
                }
            }
            $offer->save();
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

    public function chat(Request $request)
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

    public function chatInverse(Request $request)
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

    public function sendChat(Request  $request)
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

    public function getContrat()
    {
        if (Session::get('role') == env('ROLE_CARRIER')) {
            $contratc = DB::table('contract_transport')
                ->selectRaw("
                    contract_transport.id,
                    transport_announcement.origin,
                    transport_announcement.destination,
                    transport_announcement.description,
                    transport_announcement.weight
                    ")
                ->join('freight_offer', 'contract_transport.fk_freight_offert_id', '=', 'freight_offer.id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id', '=', 'transport_announcement.id')
                ->where('freight_offer.status', env('status_valid'))
                ->where('transport_announcement.fk_carrier_id', Session::get('fk_carrier_id'))
                ->orderBy('contract_transport.id','desc')
                ->get();

            $contratc->each(function ($obj){
                $obj->origin = Ville::find(intval($obj->origin));
                $obj->destination = Ville::find(intval($obj->destination));
            });


            $contrats = DB::table('contract_transport')
                ->selectRaw("
                    contract_transport.id,
                    freight_announcement.origin,
                    freight_announcement.destination,
                    freight_announcement.description,
                    freight_announcement.weight
                    ")
                ->join('transport_offer', 'contract_transport.fk_transport_offer_id', '=', 'transport_offer.id')
                ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id', '=', 'freight_announcement.id')
                ->where('transport_offer.status',  env('status_valid'))
                ->where('transport_offer.fk_carrier_id', Session::get('fk_carrier_id'))
                ->orderBy('contract_transport.id','desc')
                ->get();

            $contrats->each(function ($obj){
                $obj->origin = Ville::find(intval($obj->origin));
                $obj->destination = Ville::find(intval($obj->destination));
            });

        }elseif(Session::get('role') == env('ROLE_SHIPPER')){
            $contrats = DB::table('contract_transport')
                ->selectRaw("
                        contract_transport.id,
                        freight_announcement.origin,
                        freight_announcement.destination,
                        freight_announcement.description,
                        freight_announcement.weight
                        ")
                ->join('transport_offer', 'contract_transport.fk_transport_offer_id', '=', 'transport_offer.id')
                ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id', '=', 'freight_announcement.id')
                ->where('transport_offer.status', env('STATUS_VALID'))
                ->where('freight_announcement.fk_shipper_id', Session::get('fk_shipper_id'))
                ->orderBy('contract_transport.id', 'desc')
                ->get();

            $contrats->each(function ($obj){
                $obj->origin = Ville::find(intval($obj->origin));
                $obj->destination = Ville::find(intval($obj->destination));
            });

            $contratc = DB::table('contract_transport')
                ->selectRaw("
                        contract_transport.id,
                        transport_announcement.origin,
                        transport_announcement.destination,
                        transport_announcement.description,
                        transport_announcement.weight
                        ")
                ->join('freight_offer', 'contract_transport.fk_freight_offert_id', '=', 'freight_offer.id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id', '=', 'transport_announcement.id')
                ->where('freight_offer.status', env('STATUS_VALID'))
                ->where('freight_offer.fk_shipper_id', Session::get('fk_shipper_id'))
                ->orderBy('contract_transport.id', 'desc')
                ->get();

            $contratc->each(function ($obj){
                $obj->origin = Ville::find(intval($obj->origin));
                $obj->destination = Ville::find(intval($obj->destination));
            });
        }
        return view('pages.contrat.home',compact('contrats','contratc'));
    }

    public function getContratDetail($id)
    {
        $contrat = ContractTransport::find(intval($id));

        $contrat->detail = $contrat->contratDetail;
        if(!empty( $contrat->detail)){
            $contrat->detail->each(function($contrat){
                $contrat->car = $contrat->car;
                if(!empty($contrat->car)){
                    $contrat->car->each(function($car){
                        $car->type = $car->type;
                        $car->brand = $car->brand;
                    });
                }
                $contrat->driver = $contrat->driver;
            });
        }

        if ( isset($contrat->fk_transport_offer_id) && $contrat->fk_transport_offer_id != 0){
            $info = DB::table('transport_offer')
                ->selectRaw("
                freight_announcement.origin,
                freight_announcement.destination,
                freight_announcement.weight,
                freight_announcement.description,

                shipper.company_name as shipperName,
                shipper.address as shipperAddress,
                shipper.ifu as shipperIfu,
                shipper.rccm as shipperRccm,
                shipper.phone as shipperPhone,

                carrier.company_name as carrierName,
                carrier.address as carrierAddress,
                carrier.ifu as carrierIfu,
                carrier.rccm as carrierRccm,
                carrier.phone as carrierPhone
                ")
                ->join('contract_transport', 'transport_offer.id' , '=', 'contract_transport.fk_transport_offer_id')
                ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id','=', 'freight_announcement.id')
                ->join('carrier' , 'transport_offer.fk_carrier_id' , '=', 'carrier.id')
                ->join('shipper', 'freight_announcement.fk_shipper_id', '=', 'shipper.id')
                ->where('contract_transport.id', $id)
                ->get();
        }elseif(isset($contrat->fk_freight_offert_id) && $contrat->fk_freight_offert_id != 0){
            $info = DB::table('freight_offer')
                ->selectRaw("
                transport_announcement.origin,
                transport_announcement.destination,
                transport_announcement.weight,
                transport_announcement.description,

                shipper.company_name as shipperName,
                shipper.address as shipperAddress,
                shipper.ifu as shipperIfu,
                shipper.rccm as shipperRccm,
                shipper.phone as shipperPhone,

                carrier.company_name as carrierName,
                carrier.address as carrierAddress,
                carrier.ifu as carrierIfu,
                carrier.rccm as carrierRccm,
                carrier.phone as carrierPhone
                ")
                ->join('contract_transport', 'freight_offer.id' , '=', 'contract_transport.fk_freight_offert_id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id','=', 'transport_announcement.id')
                ->join('carrier' , 'transport_announcement.fk_carrier_id' , '=', 'carrier.id')
                ->join('shipper', 'freight_offer.fk_shipper_id', '=', 'shipper.id')
                ->where('contract_transport.id', $id)
                ->get();
        }

        return view('pages.contrat.detail', compact('contrat','info'));
    }

    public function printContrat($id)
    {
        $contract = ContractTransport::find($id);
        $contractDetails = DB::table('contract_details')
            ->selectRaw("
                contract_details.id as details_id,
                driver.id as driver_id,
                driver.licence  as licence,
                driver.first_name as driver_first,
                driver.last_name as driver_last,

                car.id as car_id,
                car.registration as car_registration

            ")
            ->join('driver', 'contract_details.driver_id' ,'=', 'driver.id')
            ->join('car', 'contract_details.cars_id' ,'=', 'car.id')
            ->where('contract_id', $id)
            ->get();
        if ( isset($contract->fk_transport_offer_id) && $contract->fk_transport_offer_id != 0){
            $contractInfos = DB::table('transport_offer')
                ->selectRaw("
                freight_announcement.origin,
                freight_announcement.destination,
                freight_announcement.weight,
                freight_announcement.description,

                shipper.company_name as shipperName,
                shipper.address as shipperAddress,
                shipper.ifu as shipperIfu,
                shipper.rccm as shipperRccm,
                shipper.phone as shipperPhone,

                carrier.company_name as carrierName,
                carrier.address as carrierAddress,
                carrier.ifu as carrierIfu,
                carrier.rccm as carrierRccm,
                carrier.phone as carrierPhone
                ")
                ->join('contract_transport', 'transport_offer.id' , '=', 'contract_transport.fk_transport_offer_id')
                ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id','=', 'freight_announcement.id')
                ->join('carrier' , 'transport_offer.fk_carrier_id' , '=', 'carrier.id')
                ->join('shipper', 'freight_announcement.fk_shipper_id', '=', 'shipper.id')
                ->where('contract_transport.id', $id)
                ->get();
        }elseif(isset($contract->fk_freight_offert_id) && $contract->fk_freight_offert_id != 0){
            $contractInfos = DB::table('freight_offer')
                ->selectRaw("
                transport_announcement.origin,
                transport_announcement.destination,
                transport_announcement.weight,
                transport_announcement.description,

                shipper.company_name as shipperName,
                shipper.address as shipperAddress,
                shipper.ifu as shipperIfu,
                shipper.rccm as shipperRccm,
                shipper.phone as shipperPhone,

                carrier.company_name as carrierName,
                carrier.address as carrierAddress,
                carrier.ifu as carrierIfu,
                carrier.rccm as carrierRccm,
                carrier.phone as carrierPhone
                ")
                ->join('contract_transport', 'freight_offer.id' , '=', 'contract_transport.fk_freight_offert_id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id','=', 'transport_announcement.id')
                ->join('carrier' , 'transport_announcement.fk_carrier_id' , '=', 'carrier.id')
                ->join('shipper', 'freight_offer.fk_shipper_id', '=', 'shipper.id')
                ->where('contract_transport.id', $id)
                ->get();
        }

        $data = [
            'details'=>$contractDetails,
            'info'=>$contractInfos
        ];
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.contrat.print_contrat',$data);

        return $pdf->stream('Contrat_de_transport.pdf');

    }

    public function updateContrat($id)
    {
        $cars = Car::where('fk_carrier_id','=',Session::get('fk_carrier_id'))->get();
        if(!empty($cars)){
            $cars->each(function ($car){
                $car->type = $car->type;
                $car->brand = $car->brand;
            });
        }
        $drivers = Driver::where('fk_carrier_id','=',Session::get('fk_carrier_id'))->get();

        $typeCars = TypeCar::all();
        $brandCars = BrandCar::all();
        $contrat = ContractTransport::find(intval($id));
        $contrat->detail = $contrat->contratDetail;
        if(!empty( $contrat->detail)){
            $contrat->detail->each(function($contrat){
                $contrat->car = $contrat->car;
                if(!empty($contrat->car)){
                    $contrat->car->each(function($car){
                        $car->type = $car->type;
                        $car->brand = $car->brand;
                    });
                }
                $contrat->driver = $contrat->driver;
            });
        }
        if ( isset($contrat->fk_transport_offer_id) && $contrat->fk_transport_offer_id != 0){
            $info = DB::table('transport_offer')
                ->selectRaw("
                freight_announcement.origin,
                freight_announcement.destination,
                freight_announcement.weight,
                freight_announcement.description,

                shipper.company_name as shipperName,
                shipper.address as shipperAddress,
                shipper.ifu as shipperIfu,
                shipper.rccm as shipperRccm,
                shipper.phone as shipperPhone,

                carrier.company_name as carrierName,
                carrier.address as carrierAddress,
                carrier.ifu as carrierIfu,
                carrier.rccm as carrierRccm,
                carrier.phone as carrierPhone
                ")
                ->join('contract_transport', 'transport_offer.id' , '=', 'contract_transport.fk_transport_offer_id')
                ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id','=', 'freight_announcement.id')
                ->join('carrier' , 'transport_offer.fk_carrier_id' , '=', 'carrier.id')
                ->join('shipper', 'freight_announcement.fk_shipper_id', '=', 'shipper.id')
                ->where('contract_transport.id', $id)
                ->get();
        }elseif(isset($contrat->fk_freight_offert_id) && $contrat->fk_freight_offert_id != 0){
            $info = DB::table('freight_offer')
                ->selectRaw("
                transport_announcement.origin,
                transport_announcement.destination,
                transport_announcement.weight,
                transport_announcement.description,

                shipper.company_name as shipperName,
                shipper.address as shipperAddress,
                shipper.ifu as shipperIfu,
                shipper.rccm as shipperRccm,
                shipper.phone as shipperPhone,

                carrier.company_name as carrierName,
                carrier.address as carrierAddress,
                carrier.ifu as carrierIfu,
                carrier.rccm as carrierRccm,
                carrier.phone as carrierPhone
                ")
                ->join('contract_transport', 'freight_offer.id' , '=', 'contract_transport.fk_freight_offert_id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id','=', 'transport_announcement.id')
                ->join('carrier' , 'transport_announcement.fk_carrier_id' , '=', 'carrier.id')
                ->join('shipper', 'freight_offer.fk_shipper_id', '=', 'shipper.id')
                ->where('contract_transport.id', $id)
                ->get();
        }
        return view('pages.contrat.update', compact('contrat','cars', 'drivers','typeCars','brandCars','info'));
    }

    public function updateStoreContrat(Request  $request)
    {
        $previousUrl  = app('router')->getRoutes(url()->previous())
            ->match(app('request')->create(url()->previous()))->getName();
        if(count($request->id_driver_contrat) ==  count($request->id_car_contrat)){

            if(!empty($request->id_car_contrat)){
                $db_details = ContractDetails::where('contract_id',intval($request->contract))->get();
                foreach ($db_details as $db){
                    $db->delete();
                }

                for($i = 0; $i < count($request->id_car_contrat); $i++ ){

                    $contractDetails = new ContractDetails();
                    $contractDetails->contract_id = intval($request->contract);
                    $contractDetails->driver_id = intval($request->id_driver_contrat[$i]);
                    $contractDetails->cars_id = intval($request->id_car_contrat[$i]);
                    $contractDetails->created_by = intval(Session::get('userId'));
                    $contractDetails->save();
                }
            }
            return redirect()->route($previousUrl,$request->contract)->with('success', 'Contrat modifié avec succès.');
        }
        elseif(count($request->id_driver_contrat) !=  count($request->id_car_contrat)){
            return redirect()->route($previousUrl,$request->contract)->with('error', 'Le nombre de camions est différent du nombre de conducteurs.');
        }
    }

    public function storeCar(form $request)
    {
        $request->validated();

        $car = new Car();
        $car->registration = $request->registration;
        $car->fk_type_car = $request->type_car;
        $car->fk_brand_car = $request->brand_car;
        $car->model = $request->model;
        $car->payload = $request->payload;
        $car->fk_carrier_id = Session::get('fk_carrier_id');
        $car->save();

        return response()->json('0');
    }

    public function updateCar(Request $request)
    {
        $car = Car::find(intval($request->id_car_up));

        $car->registration = $request->registration_up;
        $car->model = $request->model_up;
        $car->fk_brand_car = $request->brand_car_up;
        $car->fk_type_car = $request->type_car_up;
        $car->payload = $request->payload_up;

        $car->save();

        return response()->json('0');

    }

    public function deleteCar($id)
    {
        $car = Car::find(intval($id));
        $car->delete();

        return response()->json('0');
    }

    public function getCarOne($id)
    {
        $car = Car::find(intval($id));
        $car->type = $car->type;
        $car->brand = $car->brand;

        return $car;
    }

    public function storeDriver(Request $request)
    {
        $driver = new Driver();

        $driver->first_name = $request->first;
        $driver->last_name = $request->last;
        $driver->licence = $request->permis;
        $driver->date_issue = $request->date_permis;
        $driver->place_issue = $request->lieu_permis;
        $driver->fk_carrier_id = Session::get('fk_carrier_id');
        $driver->created_by = Session::get('userId');

        $driver->save();

        return response()->json('0');
    }

    public function getDriverOne($id)
    {
        return Driver::find(intval($id));
    }

    public function updateDriver(Request  $request)
    {
        $driver = Driver::find(intval($request->driver_id_up));

        $driver->first_name = $request->first_up;
        $driver->last_name = $request->last_up;
        $driver->licence = $request->permis_up;
        $driver->date_issue = $request->date_permis_up;
        $driver->place_issue = $request->lieu_permis_up;
        $driver->updated_at = date("Y-m-d");
        $driver->created_by = Session::get("userID");

        $driver->save();

        return response()->json('0');
    }

    public function deleteDriver($id)
    {
        $driver = Driver::find(intval($id));
        $driver->delete();

        return response()->json('0');
    }

    public function sendEmail()
    {

        $dataEmail = array(
            'objet'=>'Proposition de fret pour l\'offre de transport',
            'response'=>'Acceptée',
            'price'=>'35000',
            'description'=>'test',
            'offer'=>['weight'=>'30','description'=>'test 1'],
            'receiver'=>'JSC'
        );
//        foreach ($userShipper as $ship){
            Mail::to('arduino1024@gmail.com')->send(new offerApplyResponse($dataEmail));
//        }

    }


}
