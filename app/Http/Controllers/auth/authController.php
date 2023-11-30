<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\emailUpdatPasswordForm;
use App\Http\Requests\auth\loginForm;
use App\Models\Carrier;
use App\Models\Shipper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class authController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(loginForm $request)
    {
        $validated = $request->validated();
        //Get email
        $user = User::whereEmail($request->email)->first();
        //Verify if email exist
        if (!empty($user->id)) {

            switch($user->status) {
                case 0:
                    return redirect()->route('verifyEmail');
                    break;
                case 1 or 2:
                    //Verify if password is correct
                    if (Hash::check($request->password, $user->password)) {
                        $request->session()->put('userId', $user->id);
                        $request->session()->put('username', $user->username);
                        $request->session()->put('role', $user->role);
                        $request->session()->put('status', $user->status);
                        $request->session()->put('fk_carrier_id', $user->fk_carrier_id);
                        $request->session()->put('fk_shipper_id', $user->fk_shipper_id);
                        $request->session()->put('first_name', $user->first_name);
                        // Récupérer le nom de l'entreprise à partir de la table 'carrier' ou 'shipper'
                        if ($user->fk_carrier_id) {
                            $carrier = Carrier::find($user->fk_carrier_id);
                            if ($carrier) {
                                $request->session()->put('company_name', $carrier->company_name);
                            }
                        } elseif ($user->fk_shipper_id) {
                            $shipper = Shipper::find($user->fk_shipper_id);
                            if ($shipper) {
                                $request->session()->put('company_name', $shipper->company_name);
                            }
                        }
                        return redirect()->route('home');
                    }else {
                        return back()->with('fail', "Les mots de passe ne correspondent pas");
                    }
                    break;
                default:
                    return back()->with('fail', "L'email n'existe pas");
                    break;
            }
        }
    }

    public function verifyEmail()
    {
        return view('auth.verifyEmail');
    }

    public function updatePassword(emailUpdatPasswordForm  $request)
    {
        $validated = $request->validated();
        dd('test');

    }

}
