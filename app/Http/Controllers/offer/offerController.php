<?php

    namespace App\Http\Controllers\offer;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\offer\applyForm;
    use App\Http\Requests\offer\publishForm;
    use App\Http\Requests\offer\publishUpdateForm;
    use App\Mail\offer\applyOfferDelete;
    use App\Mail\offer\offerApplyResponse;
    use App\Mail\offer\offerReceive;
    use App\Mail\offer\offerSend;
    use App\Mail\offer\publishOfferDelete;
    use App\Mail\offer\publishOfferSend;
    use App\Mail\offer\publishOfferUpdate;
    use App\Models\Car;
    use App\Models\Carrier;
    use App\Models\ContractTransport;
    use App\Models\FreightAnnouncement;
    use App\Models\FreightOffer;
    use App\Models\Notification;
    use App\Models\Shipper;
    use App\Models\TransportAnnouncement;
    use App\Models\TransportCar;
    use App\Models\TransportOffer;
    use App\Models\TypeCar;
    use App\Models\User;
    use App\Models\Ville;
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

        public function countContractMonth ()
        {
            $date = new \DateTime();
            $dateDeb = $date -> format('Y-m-01 00:00:00');
            $dateFin = $date -> format('Y-m-t 23:59:59');

            if (Session::get('role') == env('ROLE_CARRIER')) {
                $contratc = DB::table('contract_transport')
                    ->selectRaw("
                    contract_transport.id
                    ")
                    ->join('freight_offer', 'contract_transport.fk_freight_offert_id', '=', 'freight_offer.id')
                    ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id', '=', 'transport_announcement.id')
                    ->where('freight_offer.status', env('STATUS_VALID'))
                    ->where('transport_announcement.fk_carrier_id', Session::get('fk_carrier_id'))
                    ->orderBy('contract_transport.id','desc')
                    ->count();
                $contratcMonth = DB::table('contract_transport')
                    ->selectRaw("
                    contract_transport.id
                    ")
                    ->join('freight_offer', 'contract_transport.fk_freight_offert_id', '=', 'freight_offer.id')
                    ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id', '=', 'transport_announcement.id')
                    ->where('freight_offer.status', env('STATUS_VALID'))
                    ->where('contract_transport.created_at', '>=', $dateDeb)
                    ->where('contract_transport.created_at', '<=', $dateFin)
                    ->where('transport_announcement.fk_carrier_id', Session::get('fk_carrier_id'))
                    ->orderBy('contract_transport.id','desc')
                    ->count();

                $contrats = DB::table('contract_transport')
                    ->selectRaw("
                    contract_transport.id
                    ")
                    ->join('transport_offer', 'contract_transport.fk_transport_offer_id', '=', 'transport_offer.id')
                    ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id', '=', 'freight_announcement.id')
                    ->where('transport_offer.status',  env('STATUS_VALID'))
                    ->where('transport_offer.fk_carrier_id', Session::get('fk_carrier_id'))
                    ->orderBy('contract_transport.id','desc')
                    ->count();

                $contratsMonth = DB::table('contract_transport')
                    ->selectRaw("
                    contract_transport.id
                    ")
                    ->join('transport_offer', 'contract_transport.fk_transport_offer_id', '=', 'transport_offer.id')
                    ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id', '=', 'freight_announcement.id')
                    ->where('transport_offer.status',  env('STATUS_VALID'))
                    ->where('contract_transport.created_at', '>=', $dateDeb)
                    ->where('contract_transport.created_at', '<=', $dateFin)
                    ->where('transport_offer.fk_carrier_id', Session::get('fk_carrier_id'))
                    ->orderBy('contract_transport.id','desc')
                    ->count();

            }elseif(Session::get('role') == env('ROLE_SHIPPER')){
                $contrats = DB::table('contract_transport')
                    ->selectRaw("  contract_transport.id
                        ")
                    ->join('transport_offer', 'contract_transport.fk_transport_offer_id', '=', 'transport_offer.id')
                    ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id', '=', 'freight_announcement.id')
                    ->where('transport_offer.status', env('STATUS_VALID'))
                    ->where('freight_announcement.fk_shipper_id', Session::get('fk_shipper_id'))
                    ->orderBy('contract_transport.id', 'desc')
                    ->count();

                $contratsMonth = DB::table('contract_transport')
                    ->selectRaw("contract_transport.id")
                    ->join('transport_offer', 'contract_transport.fk_transport_offer_id', '=', 'transport_offer.id')
                    ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id', '=', 'freight_announcement.id')
                    ->where('transport_offer.status', env('STATUS_VALID'))
                    ->where('freight_announcement.fk_shipper_id', Session::get('fk_shipper_id'))
                    ->where('contract_transport.created_at', '>=', $dateDeb)
                    ->where('contract_transport.created_at', '<=', $dateFin)
                    ->orderBy('contract_transport.id', 'desc')
                    ->count();

                $contratc = DB::table('contract_transport')
                    ->selectRaw("
                        contract_transport.id
                        ")
                    ->join('freight_offer', 'contract_transport.fk_freight_offert_id', '=', 'freight_offer.id')
                    ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id', '=', 'transport_announcement.id')
                    ->where('freight_offer.status', env('STATUS_VALID'))
                    ->where('freight_offer.fk_shipper_id', Session::get('fk_shipper_id'))
                    ->orderBy('contract_transport.id', 'desc')
                    ->count ();
                $contratcMonth = DB::table('contract_transport')
                    ->selectRaw("
                        contract_transport.id
                        ")
                    ->join('freight_offer', 'contract_transport.fk_freight_offert_id', '=', 'freight_offer.id')
                    ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id', '=', 'transport_announcement.id')
                    ->where('freight_offer.status', env('STATUS_VALID'))
                    ->where('contract_transport.created_at', '>=', $dateDeb)
                    ->where('contract_transport.created_at', '<=', $dateFin)
                    ->where('freight_offer.fk_shipper_id', Session::get('fk_shipper_id'))
                    ->orderBy('contract_transport.id', 'desc')
                    ->count ();

            }

            return [($contratc+$contrats),($contratcMonth+$contratsMonth)];

        }

        public function countAllContract ()
        {

        }

        //delete getTransportCar

        // get Entreprise
        public function getEntreprise($type,$role)
        {
            //transporteur
            if ($role == env('STATUS_VALID')){
                if($type == env('STATUS_VALID')){
                    $obj = Carrier::where('statut_juridique', '=', env('STATUS_VALID'))->get();
                }elseif($type == env('DEFAULT_VALID')){
                    $obj = Carrier::where('statut_juridique', '=', env('DEFAULT_INT'))->get();
                }
            }
            //chargeur
            elseif($role == env('DEFAULT_VALID')){
                if($type == env('STATUS_VALID')){
                    $obj = Shipper::where('statut_juridique', '=', env('STATUS_VALID'))->get();
                }elseif($type == env('DEFAULT_VALID')){
                    $obj = Shipper::where('statut_juridique', '=', env('DEFAULT_INT'))->get();
                }
            }
            return response()->json($obj);
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
                    ->where('freight_offer.status', env('STATUS_VALID'))
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
                    ->where('transport_offer.status',  env('STATUS_VALID'))
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
                $offer->id_origin = '';
                $offer->name_origin = '';

                $offer->id_destination = '';
                $offer->name_destination = '';

                if(!empty($offer->origin)){
                    $offer->id_origin = $offer->origin->id;
                    $offer->name_origin = $offer->origin->libelle;

                    $offer->id_destination = $offer->destination->id;
                    $offer->name_destination = $offer->destination->libelle;
                }

                $offer->cars = $offer->transportCar;

                $offer->cars->each(function($car){
                    $car->car  = Car::find(intval($car->fk_car));
                    if(isset( $obj->cars ) &&  !empty($obj->cars)){
                        $obj->cars->type = $obj->cars->type;
                        $obj->cars->brand = $obj->cars->brand;
                    }
                });
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
                    ->selectRaw("transport_announcement.id, transport_announcement.origin,
                        transport_announcement.destination, transport_announcement.limit_date,
                        transport_announcement.description,transport_announcement.type_price,
                       carrier.company_name,transport_announcement.price")
                    ->join('carrier', 'transport_announcement.fk_carrier_id','=', 'carrier.id')
                    ->where('limit_date', '>=', date("Y-m-d"))
                    ->orderBy('transport_announcement.price', 'DESC')
                    ->limit(10)
                    ->get();

                $offers->each(function ($offer){
                    $offer->cars = TransportCar::where('fk_transport','=', intval($offer->id))->get();

                    if( isset($offer->cars) && count($offer->cars) > env('DEFAULT_INT')){
                        $offer->cars->each(function($car){
                            $car->car = Car::find(intval($car->fk_car));
                            $car->type = TypeCar::find(intval($car->car->fk_type_car));
                        });
                    }
                    $offer->origin = Ville::find(intval($offer->origin));
                    $offer->destination = Ville::find(intval($offer->destination));
                });

                $nbOffer = $this->countFreightAnnouncements();
                $nbOfferReceived = $this->countFreightOffer();

                $nbContract = $this->countContractMonth();
                $entreprise = Shipper::all();

                return view('pages.home', compact('offers', 'nbOffer', 'nbOfferReceived','nbContract','entreprise'));

            }elseif (Session::get('role') == env('ROLE_CARRIER')){

                //Get the ten latest shipper offer
                $offers = DB::table('freight_announcement')
                    ->selectRaw("
             freight_announcement.id,freight_announcement.origin,freight_announcement.destination,freight_announcement.limit_date,
             freight_announcement.weight, freight_announcement.volume,freight_announcement.description,freight_announcement.type_price,
             shipper.company_name,freight_announcement.price
             ")
                    ->join('shipper','freight_announcement.fk_shipper_id' ,"=",'shipper.id')
                    ->where('limit_date', '>=', date("Y-m-d"))
                    ->orderBy('freight_announcement.price', 'DESC')
                    ->limit(10)
                    ->get();
                $offers->each(function ($offer){
                    $offer->origin = Ville::find(intval($offer->origin));
                    $offer->destination = Ville::find(intval($offer->destination));
                    $weightApply = TransportOffer::where('fk_freight_announcement_id', '=', $offer->id)
                        ->where('status', '=', env('STATUS_VALID'))
                        ->sum('weight');

                    if ($weightApply != 0)
                        $offer->weight = ($offer->weight - $weightApply);
                    if ($offer->weight <= 0)
                        $offer->weight = 0;
                });

                $nbContract = $this->countContractMonth ();
                $nbOffer = $this->countTransportAnnouncements();
                $nbOfferReceived = $this->countTransportOffers();
                $entreprise = Carrier::all();

                return view('pages.home', compact('offers', 'nbOffer', 'nbOfferReceived','nbContract','entreprise'));
            }elseif (Session::get('role') == env('ROLE_ADMIN')){

                //Get the ten latest carrier offer
                $offersT = DB::table('transport_announcement')
                    ->selectRaw("transport_announcement.id, transport_announcement.origin, transport_announcement.destination, transport_announcement.limit_date,
                        transport_announcement.description,
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

                $nbOffer = $this->countTransportAnnouncements();
                $nbOfferReceived = $this->countTransportOffers();
                return view('pages.admin.admin_home', compact('offersT', 'offers', 'nbOfferT', 'nbOffer', 'nbOfferReceivedT', 'nbOfferReceived'));
            }
        }

        public function storeApplyOffer(applyForm $request)
        {
            $validated = $request->validated();
            $user = User::find(intval(session('userId')));

            $notif = new Notification();
            if (Session::get('role') == env('ROLE_CARRIER')) {
                $offer = FreightAnnouncement::find(intval($request->offerId));
                $nameCarrier = Carrier::find(intval($user->fk_carrier_id));
                $nameShipper = Shipper::find($offer->fk_shipper_id);

                $shipperUsers = User::where([['fk_shipper_id', $offer->fk_shipper_id],
                    ['status', env('DEFAULT_VALID')],
                    ['email_verified','!=', env('STATUS_VALID')]
                ])->get();
                $carrierUsers = User::where([['fk_carrier_id', $user->fk_carrier_id],
                    ['status', env('DEFAULT_VALID')],
                    ['email_verified','!=', env('STATUS_VALID')]
                ])->get();

                //Add offer from shipper
                $applyOffer = new TransportOffer();
                $applyOffer->price = floatval($request->price);
                $applyOffer->description = $request->description;
                $applyOffer->duration = $request->duration;
                $applyOffer->weight = floatval($request->weight);
                $applyOffer->fk_freight_announcement_id = intval($request->offerId);
                $applyOffer->fk_carrier_id = intval(session('fk_carrier_id'));
                $applyOffer->status = env('DEFAULT_INT');
                $applyOffer->created_by = intval ($user->id);
                $applyOffer->save();

                $notif->action = env('NOTIF_ADD');
                $notif->description = 'Proposition d\'offre de transport ajoutée par '.$nameShipper->company_name.' dont le prix est '. $applyOffer->price.
                    ' et la description est '.$applyOffer->description;
                $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                $notif->status = $applyOffer->fk_carrier_id;
                $notif->save();

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

            } elseif (Session::get('role') == env('ROLE_SHIPPER')) {

                $offer = TransportAnnouncement::find(intval($request->offerId));

                $nameCarrier = Carrier::find(intval($offer->fk_carrier_id));
                $nameShipper = Shipper::find($user->fk_shipper_id);

                $shipperUsers = User::where([['fk_shipper_id', $user->fk_shipper_id],
                    ['status', env('DEFAULT_VALID')],
                    ['email_verified','!=', env('STATUS_VALID')]
                ])->get();
                $carrierUsers = User::where([['fk_carrier_id', $offer->fk_carrier_id],
                    ['status', env('DEFAULT_VALID')],
                    ['email_verified','!=', env('STATUS_VALID')]
                ])->get();

                //Add offer from shipper
                $applyOffer = new FreightOffer();
                $applyOffer->price = floatval($request->price);
                $applyOffer->description = $request->description;
                $applyOffer->duration = $request->duration;
                $applyOffer->weight = floatval($request->weight);
                $applyOffer->fk_transport_announcement_id = intval($request->offerId);
                $applyOffer->fk_shipper_id = intval($user->fk_shipper_id);
                $applyOffer->status = env('DEFAULT_INT');
                $applyOffer->created_by = intval ($user->id);
                $applyOffer->save();
                $notif->action = env('NOTIF_ADD');
                $notif->description = 'Proposition d\'offre de fret ajoutée par '.$nameShipper->company_name.' dont le prix est '. $applyOffer->price.
                    ' et la description est '.$applyOffer->description;
                $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                $notif->status = $applyOffer->fk_shipper_id;
                $notif->save();

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

            $notif = new Notification();
            if (Session::get('role') == env('ROLE_SHIPPER')){

                $obj = new FreightAnnouncement();
                $obj->origin = intval($request->origin);
                $obj->destination = intval($request->destination);
                $obj->limit_date = $request->limit_date;
                $obj->weight = $request->weight;
                $obj->duration = $request->duration;
                $obj->volume = $request->volume;
                $obj->price = $request->price;
                $obj->type_price = $request->type_price;
                $obj->description = $request->description;
                $obj->created_by = Session::get('userId');
                $obj->status = env('DEFAULT_INT');
                $obj->fk_shipper_id = Session::get('fk_shipper_id');

                $obj->save();

                //Get data to send email
                $origin = (isset($request->origin))? Ville::find(intval($request->origin)) : '';
                $destination = (isset($request->destination))? Ville::find(intval($request->destination)):'';
                $shipperObject = Shipper::find(Session::get('fk_shipper_id'));
                $itemEmail = array(
                    'origin'=>(!empty($origin))? $origin->libelle:'',
                    'destination'=> (!empty($destination))? $destination->libelle:'',
                    'name'=>$shipperObject->company_name,
                    'description'=>$request->description,
                );
                //Get all Shipper User
                $carriersUser = User::where([['fk_carrier_id', '!=', env('DEFAULT_INT')],
                    ['status', env('DEFAULT_VALID')],
                    ['email_verified','!=', env('STATUS_VALID')]])->get();
                foreach ($carriersUser as $carrier){
                    Mail::to($carrier->email)->send(new publishOfferSend($itemEmail));
                }

                $notif->action = env('NOTIF_ADD');
                $notif->description = 'Offre de fret ajoutée par '.$shipperObject->company_name.' dont le prix est '.$obj->price.
                    ' et la description est '.$obj->description;
                $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                $notif->status = env('DEFAULT_INT');
                $notif->save();
                return redirect()->route($previousUrl)->with('success', 'Offre publiée avec succès.');

            }elseif (Session::get('role') == env('ROLE_CARRIER')){

                $obj = new TransportAnnouncement();
                $obj->origin = intval($request->origin);
                $obj->destination = intval($request->destination);
                $obj->limit_date = $request->limit_date;
                $obj->price = $request->price;
                $obj->duration = $request->duration;
                $obj->type_price = $request->type_price;
                $obj->created_by = Session::get('userId');
                $obj->description = $request->description;
                $obj->status = env('DEFAULT_INT');
                $obj->fk_carrier_id = Session::get('fk_carrier_id');

                $obj->save();

                if(isset($request->id_vehicule) && count($request->id_vehicule) >0){

                    for($i=0; $i< count($request->id_vehicule); $i++){

                        $transport = new TransportCar();
                        $transport->fk_transport =  $obj->id;
                        $transport->fk_car = $request->id_vehicule[$i];
                        $transport->qte = $request->nb_vehicule[$i];

                        $transport->save();
                    }
                }

                //Get data to send email
                $origin = (isset($request->origin))? Ville::find(intval($request->origin)) : '';
                $destination = (isset($request->destination))? Ville::find(intval($request->destination)):'';
                $carrierObject = Carrier::find(Session::get('fk_carrier_id'));
                $itemEmail = array(
                    'origin'=>(!empty($origin))? $origin->libelle:'',
                    'destination'=> (!empty($destination))? $destination->libelle:'',
                    'name'=>$carrierObject->company_name,
                    'description'=>$request->description
                );
                //Get all Shipper User
                $shippersUser = User::where([['fk_shipper_id', '!=', env('DEFAULT_INT')],
                    ['status', env('DEFAULT_VALID')],
                    ['email_verified','!=', env('STATUS_VALID')]])->get();
                foreach ($shippersUser as $shipper){
                    Mail::to($shipper->email)->send(new publishOfferSend($itemEmail));
                }
                $notif->action = env('NOTIF_ADD');
                $notif->description = 'Offre de transport ajoutée par '.$carrierObject->company_name.' dont le prix est '.$obj->price.
                    ' et la description est '.$obj->description;
                $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                $notif->status = env('DEFAULT_INT');
                $notif->save();
                return redirect()->route($previousUrl)->with('success', 'Offre publiée avec succès.');
            }
        }

        public function getOffers()
        {
            if (Session::get('role') == env('ROLE_SHIPPER')){

                //Get all carrier offer
                $offers = DB::table('transport_announcement')
                    ->selectRaw("
                    transport_announcement.id,
                    transport_announcement.origin,
                    transport_announcement.destination,
                    transport_announcement.limit_date,
                    transport_announcement.description,
                    transport_announcement.type_price,
                    carrier.company_name,
                    transport_announcement.price")
                    ->join('carrier', 'transport_announcement.fk_carrier_id','=', 'carrier.id')
                    ->where('limit_date', '>=', date("Y-m-d"))
                    ->orderBy('transport_announcement.price', 'DESC')
                    ->get();

                $offers->each(function ($offer){
                    $offer->cars = TransportCar::where('fk_transport','=', intval($offer->id))->get();

                    if( isset($offer->cars) && count($offer->cars) > env('DEFAULT_INT')){
                        $offer->cars->each(function($car){
                            $car->car = Car::find(intval($car->fk_car));
                            $car->type = TypeCar::find(intval($car->car->fk_type_car));
                        });
                    }
                    $offer->origin = Ville::find(intval($offer->origin));
                    $offer->destination = Ville::find(intval($offer->destination));
                });

                return view('pages.offer.home', compact('offers'));

            }elseif (Session::get('role') == env('ROLE_CARRIER')){

                $offers = DB::table('freight_announcement')
                    ->selectRaw("
             freight_announcement.id,freight_announcement.origin,freight_announcement.destination,freight_announcement.limit_date,
             freight_announcement.weight, freight_announcement.volume,freight_announcement.description,freight_announcement.type_price,
             shipper.company_name,freight_announcement.price
             ")
                    ->join('shipper','freight_announcement.fk_shipper_id' ,"=",'shipper.id')
                    ->where('limit_date', '>=', date("Y-m-d"))
                    ->orderBy('freight_announcement.price', 'DESC')
                    ->get();
                $offers->each(function ($offer){
                    $offer->origin = Ville::find(intval($offer->origin));
                    $offer->destination = Ville::find(intval($offer->destination));

                    $weightApply = TransportOffer::where('fk_freight_announcement_id', '=', $offer->id)
                        ->where('status', '=', env('STATUS_VALID'))
                        ->sum('weight');

                    if ($weightApply != 0)
                        $offer->weight = ($offer->weight - $weightApply);
                    if ($offer->weight <= 0)
                        $offer->weight = 0;
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
                    if($offer->origin != env('DEFAULT_INT') && $offer->destination != env('DEFAULT_INT')){
                        $offer->origin = $offer->originOffer;
                        $offer->destination = $offer->destinationOffer;
                    }

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

        public function updateStatutOffer($id,$action,$duration)
        {

            $notif = new Notification();
            if (Session::get('role') == env('ROLE_CARRIER')){
                $offer = FreightOffer::find(intval($id));
                $offer->duration = $duration;
                $offer->save();
                //Get users to send email
                $tsp = $offer->transportAnnounce;
                $carriers = $tsp->carrier;
                $userCarrier = $carriers->users;
                $shipper = $offer->Shipper;
                $userShipper = $shipper->users;
                $userCarriers = [];
                $userShippers = [];

                foreach($userCarrier as $us){
                    if (  $us->email_verified != env('STATUS_VALID')){
                        array_push($userCarriers, $us);
                    }
                } foreach($userShipper as $us){
                    if (  $us->email_verified != env('STATUS_VALID')){
                        array_push($userShippers, $us);
                    }
                }

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
                        return response()->json('0');
                    }elseif(!empty($contrat) && count($contrat) > env('STATUS_VALID')){
                        foreach ($contrat as $ct){
                            $ct->delete();
                        }
                        $contrat =new ContractTransport();
                        $contrat->created_by = intval(Session::get("userId"));
                        $contrat->fk_freight_offert_id = intval($id);
                        $contrat->fk_transport_offer_id =  env('DEFAULT_INT');
                        $contrat->save();

                        foreach ($userShippers as $ship){
                            if($ship->status >= env('STATUS_VALID')){
                                Mail::to($ship->email)->send(new offerApplyResponse($dataEmail));
                            }
                        }

                        foreach ($userCarriers as $carrier){
                            if($carrier->status >= env('STATUS_VALID')){
                                Mail::to($carrier->email)->send(new offerApplyResponse($dataEmailCarrier));
                            }
                        }

                        $notif->action = env('NOTIF_ADD');
                        $notif->description = 'Contrat de transport ajouté entre '.$carriers->company_name.' et '.$shipper->company_name;
                        $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                        $notif->status = env('DEFAULT_INT');
                        $notif->save();
                    }
                    else{
                        $contrat =new ContractTransport();
                        $contrat->created_by = intval(Session::get("userId"));
                        $contrat->fk_freight_offert_id = intval($id);
                        $contrat->fk_transport_offer_id =  env('DEFAULT_INT');
                        $contrat->save();

                        foreach ($userShippers as $ship){
                            if($ship->status >= env('STATUS_VALID')){
                                Mail::to($ship->email)->send(new offerApplyResponse($dataEmail));
                            }
                        }
                        foreach ($userCarriers as $carrier){
                            if($carrier->status >= env('STATUS_VALID')){
                                Mail::to($carrier->email)->send(new offerApplyResponse($dataEmailCarrier));
                            }
                        }
                        $notif->action = env('NOTIF_ADD');
                        $notif->description = 'Contrat de transport ajouté entre '.$carriers->company_name.' et '.$shipper->company_name;
                        $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                        $notif->status = env('DEFAULT_INT');
                        $notif->save();
                    }
                }

                elseif (intval($action) == env('DEFAULT_VALID')){
                    $offer->status = env('DEFAULT_VALID');
                    if(!empty($contrat)){
                        foreach ($contrat as $ct){
                            $ct->delete();
                        }
                        foreach ($userShippers as $ship){
                            if($ship->status >= env('STATUS_VALID')){
                                Mail::to($ship->email)->send(new offerApplyResponse($dataEmailRefuser));
                            }
                        }
                        foreach ($userCarriers as $carrier){
                            if($carrier->status >= env('STATUS_VALID')){
                                Mail::to($carrier->email)->send(new offerApplyResponse($dataEmailCarrierRefuser));
                            }
                        }
                    }
                }
                $offer->save();
                return response()->json('0');

            }elseif (Session::get('role') == env('ROLE_SHIPPER')){

                $offer = TransportOffer::find(intval($id));
                $offer->duration = $duration;
                $offer->save();
                //Get users to send email
                $tsp = $offer->freightAnnouncement;
                $carriers = $offer->Carrier;
                $userCarrier = $carriers->users;
                $shipper = $tsp->Shipper;
                $userShipper = $shipper->users;
                $userCarriers = [];
                $userShippers = [];

                foreach($userCarrier as $us){
                    if (  $us->email_verified != env('STATUS_VALID')){
                        array_push($userCarriers, $us);
                    }
                } foreach($userShipper as $us){
                    if (  $us->email_verified != env('STATUS_VALID')){
                        array_push($userShippers, $us);
                    }
                }

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
                if (intval($action) == env('DEFAULT_VALID')){
                    $offer->status = env('DEFAULT_VALID');
                    if(!empty($contrat)){
                        foreach ($contrat as $ct){
                            $ct->delete();
                        }
                        foreach ($userShippers as $ship){
                            if($ship->status >= env('STATUS_VALID')){
                                Mail::to($ship->email)->send(new offerApplyResponse($dataEmailShipperRefuser));
                            }
                        }
                        foreach ($userCarriers as $carrier){
                            if($carrier->status >= env('STATUS_VALID')){
                                Mail::to($carrier->email)->send(new offerApplyResponse($dataEmailRefuser));
                            }
                        }
                    }
                }
                elseif (intval($action) == env('STATUS_VALID')){
                    $offer->status = env('STATUS_VALID');
                    if(!empty($contrat) && count($contrat)== env('STATUS_VALID')){
                        return response()->json('0');
                    }elseif(!empty($contrat) && count($contrat) > env('STATUS_VALID')){
                        foreach ($contrat as $ct){
                            $ct->delete();
                        }
                        $contrat =new ContractTransport();
                        $contrat->created_by = intval(Session::get("userId"));
                        $contrat->fk_freight_offert_id = env('DEFAULT_INT');
                        $contrat->fk_transport_offer_id = intval($id);
                        $contrat->save();

                        foreach ($userShippers as $ship){
                            if($ship->status >= env('STATUS_VALID')){
                                Mail::to($ship->email)->send(new offerApplyResponse($dataEmailShipper));
                            }
                        }
                        foreach ($userCarriers as $carrier){
                            if($carrier->status >= env('STATUS_VALID')){
                                Mail::to($carrier->email)->send(new offerApplyResponse($dataEmail));
                            }
                        }
                        $notif->action = env('NOTIF_ADD');
                        $notif->description = 'Contrat de transport ajouté entre '.$carriers->company_name.' et '.$shipper->company_name;
                        $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                        $notif->status = env('DEFAULT_INT');
                        $notif->save();
                    }
                    else{
                        $contrat =new ContractTransport();
                        $contrat->created_by = intval(Session::get("userId"));
                        $contrat->fk_freight_offert_id = env('DEFAULT_INT');
                        $contrat->fk_transport_offer_id = intval($id);
                        $contrat->save();


                        foreach ($userShippers as $ship){
                            if($ship->status >= env('STATUS_VALID')){
                                Mail::to($ship->email)->send(new offerApplyResponse($dataEmailShipper));
                            }
                        }

                        foreach ($userCarriers as $carrier){
                            if($carrier->status >= env('STATUS_VALID')){
                                Mail::to($carrier->email)->send(new offerApplyResponse($dataEmail));
                            }
                        }
                        $notif->action = env('NOTIF_ADD');
                        $notif->description = 'Contrat de transport ajouté entre '.$carriers->company_name.' et '.$shipper->company_name;
                        $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                        $notif->status = env('DEFAULT_INT');
                        $notif->save();
                    }
                }

                $offer->save();
                return response()->json('0');
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
                    if( $offer->origin != env('DEFAULT_INT') && $offer->destination != env('DEFAULT_INT')){
                        $offer->origin = $offer->originOffer;
                        $offer->destination = $offer->destinationOffer;
                    }
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

        public function deletePublishOffer($id)
        {

            if (Session::get('role') == env('ROLE_SHIPPER')){

                $offer = FreightAnnouncement::find( intval($id) );
                //Get all Shipper User
                $shippersUser = User::where([['fk_shipper_id', '=', Session::get('fk_shipper_id')],['status', env('DEFAULT_VALID')],
                    ['email_verified','!=', env('STATUS_VALID')]])->get();
                $data = array(
                    'name' => Session::get('first_name').' '.Session::get('first_name'),
                    'description' => $offer->description,
                    'origin' => $offer->originOffer->libelle,
                    'destination' => $offer->destinationOffer->libelle,
                );
                foreach ($shippersUser as $shipper){
                    Mail::to($shipper->email)->send(new publishOfferDelete($data));
                }
                if ( Session::get('fk_shipper_id') == $offer->fk_shipper_id && $offer->status < env('DEFAULT_VALID')){

                    $offer->delete();
                    return 0 ;
                }else{
                    return 1 ;
                }
            }elseif (Session::get('role') == env('ROLE_CARRIER')){

                $offer = TransportAnnouncement::find( intval($id) );

                //Get all Carrier User
                $carriersUser = User::where([['fk_carrier_id', '=', Session::get('fk_carrier_id')],['status', env('DEFAULT_VALID')],
                                            ['email_verified','!=', env('STATUS_VALID')]])->get();
                $data = array(
                    'name' => Session::get('first_name').' '.Session::get('first_name'),
                    'description' => $offer->description,
                    'origin' => $offer->originOffer->libelle,
                    'destination' => $offer->destinationOffer->libelle,
                );
                foreach ($carriersUser as $carrier){
                    Mail::to($carrier->email)->send(new publishOfferDelete($data));
                }

                if ( Session::get('fk_carrier_id') == $offer->fk_carrier_id && $offer->status < env('DEFAULT_VALID')){

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
                $shippersUser = User::where([['fk_shipper_id', '=', Session::get('fk_shipper_id')],['status', env('DEFAULT_VALID')],
                                            ['email_verified','!=', env('STATUS_VALID')]])->get();
                $carriersUser = User::where([['fk_carrier_id', '=', $carrier_fk],['status', env('DEFAULT_VALID')],
                                            ['email_verified','!=', env('STATUS_VALID')]])->get();
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
                 $carriersUser = User::where([['fk_carrier_id', '=', Session::get('fk_carrier_id')],['status', env('DEFAULT_VALID')],
                                            ['email_verified','!=', env('STATUS_VALID')]])->get();
                 $shippersUser = User::where([['fk_shipper_id', '=', $shipper_fk],['status', env('DEFAULT_VALID')],
                                            ['email_verified','!=', env('STATUS_VALID')]])->get();
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

        $notif = new Notification();
        if (Session::get('role') == env('ROLE_CARRIER')) {

            $offer = TransportOffer::find(intval($request->offerId));

            $offerFreight = FreightAnnouncement::find(intval($offer->fk_freight_announcement_id));
            $nameShipper= Shipper::find(intval($offerFreight->fk_shipper_id));
            $nameCarrier = Carrier::find($offer->fk_carrier_id);

            $shipperUsers = User::where([['fk_shipper_id', $nameShipper->id], ['status','>=', env('DEFAULT_VALID')],
                                        ['email_verified','!=', env('STATUS_VALID')]])->get();
            $carrierUsers = User::where([['fk_carrier_id', $nameCarrier->id], ['status','>=', env('DEFAULT_VALID')],
                                        ['email_verified','!=', env('STATUS_VALID')]])->get();

            $offer->price = floatval($request->price);
            $offer->description = $request->description;
            $offer->updated_at = date("Y-m-d H:i:s");

            //Get data to send email
            $data['price'] = $request->price;
            $data['description'] = $request->description;
            $data['offer'] = $offer;
            $data['receiver'] =  $nameShipper->company_name;
            $data['sender'] =$nameCarrier->company_name;

            //Send mail
            foreach ($carrierUsers as $carrier){
                Mail::to($carrier->email)->send(new offerSend($data));

            }
            foreach ($shipperUsers as $shipper){
                Mail::to($shipper->email)->send(new offerReceive($data));
            }
            $notif->action = env('NOTIF_UP');
            $notif->description = 'Proposition d\'offre de transport mise à jour par '.$nameCarrier->company_name.' dont le prix est '.$offer->price.
                ' et la description '.$offer->description;
            $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
            $notif->status = $nameShipper->id;
            $notif->save();

        } elseif (Session::get('role') == env('ROLE_SHIPPER')) {

            $offer = FreightOffer::find(intval($request->offerId));

            $offerTransport = TransportAnnouncement::find(intval($offer->fk_transport_announcement_id));
            $nameCarrier = Carrier::find(intval($offerTransport->fk_carrier_id));
            $nameShipper = Shipper::find($offer->fk_shipper_id);

            $shipperUsers = User::where([['fk_shipper_id', $nameShipper->id], ['status','>=', env('DEFAULT_VALID')],
                                        ['email_verified','!=', env('STATUS_VALID')]])->get();
            $carrierUsers = User::where([['fk_carrier_id', $nameCarrier->id], ['status','>=', env('DEFAULT_VALID')],
                                        ['email_verified','!=', env('STATUS_VALID')]])->get();

            $offer->price = floatval($request->price);
            $offer->weight = floatval($request->weight);
            $offer->description = $request->description;
            $offer->updated_at = date("Y-m-d H:i:s");
            $offer->save();

            //Get data to send email
            $data['price'] = $request->price;
            $data['description'] = $request->description;
            $data['offer'] = $offer;
            $data['receiver'] = $nameCarrier->company_name;
            $data['sender'] = $nameShipper->company_name;

            $notif->action = env('NOTIF_UP');
            $notif->description = 'Proposition d\'offre de fret mise à jour par '.$nameShipper->company_name.' dont le prix est '.$offer->price.
                ' et la description '.$offer->description;
            $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
            $notif->status = $nameCarrier->id;
            $notif->save();

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


        public function updatePublishOffer(publishUpdateForm $request)
        {

            $previousUrl  = app('router')->getRoutes(url()->previous())
                ->match(app('request')->create(url()->previous()))->getName();
            $notif = new Notification();

            if (Session::get('role') == env('ROLE_SHIPPER')){
                $shipperObject = Shipper::find(Session::get('fk_shipper_id'));

                $offer = FreightAnnouncement::find(intval($request->id_offer_up));
                if($offer->fk_shipper_id == Session::get('fk_shipper_id')){

                    $offer->origin = $request->origin_up;
                    $offer->destination = $request->destination_up;
                    $offer->weight = $request->weight_up;
                    $offer->price = $request->price_up;
                    $offer->type_price = $request->type_price_up;
                    $offer->volume =  $request->volume_up;
                    $offer->limit_date = $request->limit_date_up;
                    $offer->description = $request->description_up;
                    $offer->created_by = Session::get('userId');
                    $offer->updated_at = date("Y-m-d H:i:s");

                    $offer->save();

                    $notif->action = env('NOTIF_UP');
                    $notif->description = 'Offre de fret mise à jour par '.$shipperObject->company_name.' dont le prix est '.$offer->price.
                        ' et la description '.$offer->description;
                    $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                    $notif->status = env('DEFAULT_INT');
                    $notif->save();
                }else{
                    return redirect()->route($previousUrl)->with('danger', 'Vous n\êtes pas autorisé à modifier .');
                }

                //Get data to send email
                $origin = Ville::find(intval($request->origin_up));
                $destination = Ville::find(intval($request->destination_up));
                $itemEmail = array(
                    'origin'=>$origin->libelle,
                    'destination'=>$destination->libelle,
                    'name'=>$shipperObject->company_name,
                    'description'=>$request->description_up,
                );
                //Get all Carrier User
                $carriersUser = User::where([['fk_carrier_id', '!=', env('DEFAULT_INT')],
                    ['status', env('DEFAULT_VALID')],
                    ['email_verified','!=', env('STATUS_VALID')]])->get();
                foreach ($carriersUser as $carrier){
                    Mail::to($carrier->email)->send(new publishOfferSend($itemEmail));
                }

                return redirect()->route($previousUrl)->with('success', 'Offre modifiée avec succès.');
            }
            elseif (Session::get('role') == env('ROLE_CARRIER')){

                $carrierObject = Carrier::find(Session::get('fk_carrier_id'));

                $offer = TransportAnnouncement::find(intval($request->id_offer_up));

                if($offer->fk_carrier_id == Session::get('fk_carrier_id')){

                    $offer->origin = $request->origin_up;
                    $offer->destination = $request->destination_up;
                    $offer->price = $request->price_up;
                    $offer->type_price = $request->type_price_up;
                    $offer->limit_date = $request->limit_date_up;
                    $offer->description = $request->description_up;
                    $offer->created_by = Session::get('userId');
                    $offer->updated_at = date("Y-m-d H:i:s");
                    $offer->save();

                    if(isset($request->id_vehicule_up) && count($request->id_vehicule_up) >0){
                        $transports = TransportCar::where('fk_transport','=',$request->id_offer_up)->get();
                        foreach ($transports as $ts){

                            $ts->delete();
                        }

                        for($i=0; $i< count($request->id_vehicule_up); $i++){
                            $transport = new TransportCar();
                            $transport->fk_transport =  $offer->id;
                            $transport->fk_car = $request->id_vehicule_up[$i];
                            $transport->qte = $request->nb_vehicule_up[$i];

                            $transport->save();
                        }
                    }

                    $notif->action = env('NOTIF_UP');
                    $notif->description = 'Offre de transport mise à jour par '.$carrierObject->company_name.' dont le prix est '.$offer->price.
                        ' et la description '.$offer->description;
                    $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                    $notif->status = env('DEFAULT_INT');
                    $notif->save();
                }else{
                    return redirect()->route($previousUrl)->with('danger', 'Vous n\êtes pas autorisé à modifier .');
                }

                //Get data to send email
                $origin = ( !empty(Ville::find(intval($request->origin_up))) ) ? Ville::find(intval($request->origin_up)) : '' ;
                $destination = ( !empty(Ville::find(intval($request->destination_up))) ) ? Ville::find(intval($request->destination_up)) : '' ;
                $itemEmail = array(
                    'origin'=>(!empty($origin))? $origin->libelle: '',
                    'destination'=>(!empty($destination))?$destination->libelle:'',
                    'name'=>$carrierObject->company_name,
                    'description'=>$request->description_up,
                );
                //Get all Shipper User
                $shippersUser = User::where([['fk_shipper_id', '!=', env('DEFAULT_INT')],['status', env('DEFAULT_VALID')],
                    ['email_verified','!=', env('STATUS_VALID')]])->get();
                foreach ($shippersUser as $shipper){
                    Mail::to($shipper->email)->send(new publishOfferUpdate($itemEmail));
                }
                return redirect()->route($previousUrl)->with('success', 'Offre modifiée avec succès.');
            }

        }
    }
