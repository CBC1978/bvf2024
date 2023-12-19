<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\auth\emailUpdatPasswordForm;
use App\Http\Requests\auth\loginForm;
use App\Models\Carrier;
use App\Models\Shipper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
                        $request->session()->put('last_name', $user->last_name);
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

    public function getUsersValide()
    {
        return view('pages.user.home_valide');

        if (Session::get('role') == env('ROLE_SHIPPER')){

        }elseif (Session::get('role') == env('ROLE_CARRIER')){

        }elseif (Session::get('role') == env('ROLE_ADMIN')){

        }

    }

    public function logout(Request $request)
    {
        Auth::logout(); // Déconnecte l'utilisateur
        $request->session()->forget('userId');
        Session::flush(); // Vide la session
        return redirect()->route('index');
    }

}
