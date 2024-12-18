<?php

namespace App\Http\Controllers\conducteur;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Session;

class conducteurController extends Controller
{
    public function storeDriver(\Symfony\Component\HttpFoundation\Request $request)
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
    public function deleteDriver($id)
    {
        $driver = Driver::find(intval($id));
        $driver->delete();

        return response()->json('0');
    }

    public function updateDriver(\Symfony\Component\HttpFoundation\Request $request)
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

    public function getDrivers()
    {
        $drivers = Driver::where('fk_carrier_id','=',Session::get('fk_carrier_id'))->get();

        return response()->json($drivers);
    }


}
