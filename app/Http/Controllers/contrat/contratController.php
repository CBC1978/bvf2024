<?php

namespace App\Http\Controllers\contrat;

use App\Http\Controllers\Controller;
use App\Http\Requests\car\form;
use App\Models\BrandCar;
use App\Models\Car;
use App\Models\Carrier;
use App\Models\ContractDetails;
use App\Models\ContractTransport;
use App\Models\Driver;
use App\Models\Notification;
use App\Models\TypeCar;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class contratController extends Controller
{
    public function getContrat()
    {
        if (Session::get('role') == env('ROLE_CARRIER')) {
            $contratc = DB::table('contract_transport')
                ->selectRaw("
                    contract_transport.id,
                    transport_announcement.origin,
                    transport_announcement.destination,
                    transport_announcement.description
                    ")
                ->join('freight_offer', 'contract_transport.fk_freight_offert_id', '=', 'freight_offer.id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id', '=', 'transport_announcement.id')
                ->where('freight_offer.status', env('STATUS_VALID'))
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
                ->where('transport_offer.status',  env('STATUS_VALID'))
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
                        transport_announcement.description
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


    public function updateStoreContrat(\Symfony\Component\HttpFoundation\Request $request)
    {
        $previousUrl  = app('router')->getRoutes(url()->previous())
            ->match(app('request')->create(url()->previous()))->getName();
        $notif = new Notification();
        if ( is_array($request->id_driver_contrat) && is_array($request->id_car_contrat)){
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
                    $carrier = Carrier::find(intval(Session::get('fk_carrier_id')));

                    $notif->action = env('NOTIF_UP');
                    $notif->description = 'Contrat de transport, ajout de camions par '.$carrier->company_name;
                    $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
                    $notif->status = $carrier->id;
                    $notif->save();
                }
                return redirect()->route($previousUrl,$request->contract)->with('success', 'Contrat modifié avec succès.');
            }
            elseif(count($request->id_driver_contrat) !=  count($request->id_car_contrat)){
                session()->flash('Le nombre de camions est différent du nombre de conducteurs.', 'error');
                return redirect()->route($previousUrl,$request->contract);
            }
        }else{
            $db_details = ContractDetails::where('contract_id',intval($request->contract))->get();
            foreach ($db_details as $db){
                $db->delete();
            }
            return redirect()->route($previousUrl,$request->contract)->with('error', 'Aucun camion ajouté ou aucun conducteur ajouté.');
        }

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
                car.registration as car_registration,
                car.model as car_model,
                car.fk_type_car as car_type,
                car.fk_brand_car as car_brand

            ")
            ->join('driver', 'contract_details.driver_id' ,'=', 'driver.id')
            ->join('car', 'contract_details.cars_id' ,'=', 'car.id')
            ->where('contract_id', $id)
            ->get();
        if(!empty($contractDetails)){
            $contractDetails->each(function($contract){
                $contract->type = TypeCar::find($contract->car_type);
                $contract->brand = BrandCar::find($contract->car_brand);
            });
        }
        if ( isset($contract->fk_transport_offer_id) && $contract->fk_transport_offer_id != 0){
            $contractInfos = DB::table('transport_offer')
                ->selectRaw("
                freight_announcement.origin as origin,
                freight_announcement.destination as destination,
                freight_announcement.weight,
                freight_announcement.description as nature,

                shipper.company_name as shipperName,
                shipper.address as shipperAddress,
                shipper.ifu as shipperIfu,
                shipper.rccm as shipperRccm,
                shipper.phone as shipperPhone,
                shipper.signature as shipperSignature,
                shipper.name bossShipperName,

                carrier.company_name as carrierName,
                carrier.address as carrierAddress,
                carrier.ifu as carrierIfu,
                carrier.rccm as carrierRccm,
                carrier.phone as carrierPhone,
                carrier.signature as carrierSignature,
                carrier.name bossCarrierName,

                transport_offer.duration as duration
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
                transport_announcement.origin as origin,
                transport_announcement.destination as destination,
                transport_announcement.description,

                shipper.company_name as shipperName,
                shipper.address as shipperAddress,
                shipper.ifu as shipperIfu,
                shipper.rccm as shipperRccm,
                shipper.phone as shipperPhone,
                 shipper.signature as shipperSignature,
                shipper.name bossShipperName,

                carrier.company_name as carrierName,
                carrier.address as carrierAddress,
                carrier.ifu as carrierIfu,
                carrier.rccm as carrierRccm,
                carrier.phone as carrierPhone,
                carrier.signature as carrierSignature,
                carrier.name bossCarrierName,

                freight_offer.duration as duration,
                freight_offer.description as nature
                ")
                ->join('contract_transport', 'freight_offer.id' , '=', 'contract_transport.fk_freight_offert_id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id','=', 'transport_announcement.id')
                ->join('carrier' , 'transport_announcement.fk_carrier_id' , '=', 'carrier.id')
                ->join('shipper', 'freight_offer.fk_shipper_id', '=', 'shipper.id')
                ->where('contract_transport.id', $id)
                ->get();
        }
        if(!empty($contractInfos)){
            $contractInfos->each(function($contract){
                $contract->origin = Ville::find($contract->origin);
                $contract->destination = Ville::find($contract->destination);
            });
        }

        $data = [
            'details'=>$contractDetails,
            'info'=>$contractInfos
        ];
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.contrat.print_contrat',$data);

        return $pdf->stream('Contrat_de_transport.pdf');

    }


}
