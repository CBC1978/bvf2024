<?php

namespace App\Http\Controllers\voiture;

use App\Http\Controllers\Controller;
use App\Http\Requests\car\form;
use App\Models\BrandCar;
use App\Models\Car;
use App\Models\Carrier;
use App\Models\Notification;
use App\Models\TransportCar;
use App\Models\TypeCar;

use \Symfony\Component\HttpFoundation\Request;
use Session;

class voitureController extends Controller
{
    public function getAllTypeCar()
    {
        return TypeCar::all();
    }

    public function getAllBrandCar()
    {
        return BrandCar::all();
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

    public function getTransportCar($id)
    {
        $cars = TransportCar::where('fk_transport', '=', $id)->get();
        $cars->each(function ($obj){
            $obj->cars = $obj->Cars;
            if(isset( $obj->cars ) &&  !empty($obj->cars)){
                $obj->cars->type = $obj->cars->type;
                $obj->cars->brand = $obj->cars->brand;
            }
        });
        return $cars;
    }

    public function getVehicule()
    {
        $cars = Car::where('fk_carrier_id' ,'=', Session('fk_carrier_id'))->get();
        $types = TypeCar::all();
        $brands = BrandCar::all();
        $cars->each(function($obj){
            $obj->fk_type =$obj->type;
            $obj->fk_brand =$obj->brand;

        });
        return view('pages.vehicule.home', compact('cars','types','brands'));
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

        if($request->file('image')){
            $image = $request->file('image');
            $name = $request->registration.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/car');
            $image->move($destinationPath, $name);
            $car->image = $name;
        }

        $car->save();

        $carrier = Carrier::find(Session::get('fk_carrier_id'));
        $notif = new Notification();
        $notif->action = env('NOTIF_ADD');
        $notif->description = 'Camions de transport ajoutés par '.$carrier->company_name;
        $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
        $notif->status = $carrier->id;
        $notif->save();

        return redirect()->route('getVehicule');
    }

    public function getCarOne($id)
    {
        $car = Car::find(intval($id));
        $car->type = $car->type;
        $car->brand = $car->brand;

        return $car;

    }

    public function updateCar(\Symfony\Component\HttpFoundation\Request $request)
    {
        $car = Car::find(intval($request->id_car_up));

        $car->registration = $request->registration_up;
        $car->model = $request->model_up;
        $car->fk_brand_car = $request->brand_car_up;
        $car->fk_type_car = $request->type_car_up;
        $car->payload = $request->payload_up;
        if($request->file('image')){
            $image = $request->file('image');
            $name = $request->registration.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/car');
            $image->move($destinationPath, $name);
            $car->image = $name;
        }

        $car->save();

        $carrier = Carrier::find(Session::get('fk_carrier_id'));
        $notif = new Notification();
        $notif->action = env('NOTIF_UP');
        $notif->description = 'Camions de transport modifiés par '.$carrier->company_name;
        $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
        $notif->status = $carrier->id;
        $notif->save();

        return redirect()->route('getVehicule');
    }

    public function deleteCar($id)
    {
        $car = Car::find(intval($id));
        $car->delete();

        return response()->json('0');
    }

    public function storeCarContrat(form $request)
    {
        $request->validated();

        $car = new Car();
        $car->registration = $request->registration;
        $car->fk_type_car = $request->type_car;
        $car->fk_brand_car = $request->brand_car;
        $car->model = $request->model;
        $car->payload = $request->payload;
        $car->fk_carrier_id = Session::get('fk_carrier_id');

        if($request->file('image')){
            $image = $request->file('image');
            $name = $request->registration.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/car');
            $image->move($destinationPath, $name);
            $car->image = $name;
        }

        $car->save();

        $carrier = Carrier::find(Session::get('fk_carrier_id'));
        $notif = new Notification();
        $notif->action = env('NOTIF_ADD');
        $notif->description = 'Camions de transport ajoutés par '.$carrier->company_name;
        $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
        $notif->status = $carrier->id;
        $notif->save();
        return response()->json('0');
    }

    public function getVehicules()
    {
        $cars = Car::where('fk_carrier_id' ,'=', Session('fk_carrier_id'))->get();

        $cars->each(function($obj){
            $obj->fk_type =$obj->type;
            $obj->fk_brand =$obj->brand;
        });
        return response()->json($cars);
    }

    public function updateCarContrat(\Symfony\Component\HttpFoundation\Request $request)
    {
        $car = Car::find(intval($request->id_car_up));

        $car->registration = $request->registration_up;
        $car->model = $request->model_up;
        $car->fk_brand_car = $request->brand_car_up;
        $car->fk_type_car = $request->type_car_up;
        $car->payload = $request->payload_up;

        $car->save();

        $carrier = Carrier::find(Session::get('fk_carrier_id'));
        $notif = new Notification();
        $notif->action = env('NOTIF_UP');
        $notif->description = 'Camions de transport modifiés par '.$carrier->company_name;
        $notif->created_by = Session::get('first_name').' '.Session::get('last_name');
        $notif->status = $carrier->id;
        $notif->save();

        return redirect('');
    }
}
