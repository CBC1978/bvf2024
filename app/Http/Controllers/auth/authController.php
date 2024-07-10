<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\auth\updateProfil;
use App\Mail\RegisterEmails;
use App\Http\Controllers\auth\Helper;
use App\Http\Requests\auth\emailUpdatPasswordForm;
use App\Http\Requests\auth\loginForm;
use App\Mail\ResetPasswordEmail;
use App\Models\Carrier;
use App\Models\Notification;
use App\Models\Shipper;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;


use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Mail\ValidatedRegisterEmails;
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
                        $request->session()->put('email', $user->email);
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


    public function updatePassword(Request $request)
    {
        $newPassword = Str::random(10);

        $user = User::where('email', $request->email1)->first();
        if ($user){
        // Mettre à jour le mot de passe de l'utilisateur dans la base de données
        $user->password = Hash::make($newPassword);
        $user->save();
        // Envoyer le nouveau mot de passe par e-mail
        Mail::to($user->email)->send(new ResetPasswordEmail($user->name, $newPassword));

        return redirect()->route('index')->with('success', 'Votre mot de passe a été réinitialisé. Veuillez vérifier votre e-mail pour le nouveau mot de passe.');
        }
        else{
            return back()->with('fail', "L'email n'existe pas");
        }
}


    public function getUsersValide()
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $users = User::where('status','!=',env('STATUS_VALID'))
                ->where('status','!=',env('DEFAULT_INT'))
                ->where('fk_shipper_id','=',Session::get('fk_shipper_id'))
                ->get();

            $users->each(function($user){
                if ($user->fk_shipper_id != env('DEFAULT_INT')){
                    $user->company = $user->shipper;
                }
            });

            return view('pages.user.home_valide', compact('users'));

        }elseif (Session::get('role') == env('ROLE_CARRIER')){

            $users = User::where('status','!=',env('STATUS_VALID'))
                ->where('status','!=',env('DEFAULT_INT'))
                ->where('fk_carrier_id','=',Session::get('fk_carrier_id'))
                ->get();
            $users->each(function($user){
                if ($user->fk_carrier_id != env('DEFAULT_INT')) {
                    $user->company = $user->carrier;
                }
            });
            return view('pages.user.home_valide', compact('users'));

        }elseif (Session::get('role') == env('ROLE_ADMIN')){

            $users = User::where('status','!=',env('STATUS_VALID'))
                ->where('status','!=' , env('DEFAULT_INT'))
                ->get();

            $users->each(function($user){
                if ($user->fk_carrier_id != env('DEFAULT_INT')) {
                    $user->company = $user->carrier;
                }
                elseif ($user->fk_shipper_id != env('DEFAULT_INT')){
                    $user->company = $user->shipper;
                }
            });

            return view('pages.admin.utilisateur.home_valide_admin',compact('users'));
        }
    }

    public function getUsersNoValide()
    {
        if (Session::get('role') == env('ROLE_SHIPPER')){

            $users = User::where('status','=',env('STATUS_VALID'))
                ->where('fk_shipper_id','=',Session::get('fk_shipper_id'))
                ->get();

            $users->each(function($user){
                if ($user->fk_shipper_id != env('DEFAULT_INT')){
                    $user->company = $user->shipper;
                }
            });

            return view('pages.user.home_non_valide', compact('users'));

        }elseif (Session::get('role') == env('ROLE_CARRIER')){

            $users = User::where('status','=',env('STATUS_VALID'))
                ->where('fk_carrier_id','=',Session::get('fk_carrier_id'))
                ->get();

            $users->each(function($user){
                if ($user->fk_carrier_id != env('DEFAULT_INT')){
                    $user->company = $user->shipper;
                }
            });

            return view('pages.user.home_non_valide', compact('users'));

        }
       elseif (Session::get('role') == env('ROLE_ADMIN')){ //gestion users compte admin
           $users = User::where('status','=',env('STATUS_VALID'))
               ->get();

           $users->each(function($user){

               if ($user->fk_carrier_id != env('DEFAULT_INT')) {
                   $user->company = $user->carrier;

                   $count = User::where('fk_carrier_id','=',$user->fk_carrier_id)->get();
                   if(count($count) > env('DEFAULT_INT') && count($count) == env('STATUS_VALID')){
                       $user->count = env('STATUS_VALID');
                   }elseif (count($count) != env('STATUS_VALID')){
                       $user->count = count($count);
                   }
               }
               elseif ($user->fk_shipper_id != env('DEFAULT_INT')){
                   $user->company = $user->shipper;
                   $count = User::where('fk_shipper_id','=',$user->fk_shipper_id)->get();
                   if(count($count) > env('DEFAULT_INT') && count($count) == env('STATUS_VALID')){
                       $user->count = env('STATUS_VALID');
                   }elseif (count($count) != env('STATUS_VALID')){
                       $user->count = count($count);
                   }
               }
           });
            return view('pages.admin.utilisateur.home_no_valide_admin', compact('users'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Déconnecte l'utilisateur
        $request->session()->forget('userId');
        Session::flush(); // Vide la session
        return redirect()->route('index');
    }

// pool of register and otp functions

public function index2()
{
    $villes = Ville::all();
    return view('auth.register', compact('villes'));
}


    public function register(Request $request)
    {
        $request->validate([

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'role' => ['required', 'string', 'in:chargeur,transporteur'],
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->user_phone = $request->user_phone;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->email_verified = env('DEFAULT_INT');
        $user->code = Helper::random_int(5, 9999);
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = env('DEFAULT_INT');

        if($request->role == env('ROLE_CARRIER')){
            if ($request->id_company !=env('DEFAULT_INT')){

                $user->fk_carrier_id = $request->id_company;
            }else{
                $carrier = new Carrier();
                $carrier->company_name = $request->company_name;
                $carrier->address = $request->adresse;
                $carrier->phone = $request->user_phone;
                $carrier->email = $request->email;
                $carrier->city = $request->ville_company;
                $carrier->ifu = env('DEFAULT_INT');
                $carrier->rccm = env('DEFAULT_INT');
                $carrier->created_by = env('DEFAULT_INT');

                if ($request->type_company == env('DEFAULT_INT')){
                    $carrier->type = env('DEFAULT_INT');
                }elseif($request->type_company == env('STATUS_VALID')){
                    $carrier->type = env('STATUS_VALID');
                }

                $carrier->save();

                $user->fk_carrier_id = $carrier->id;
            }
        }elseif($request->role == env('ROLE_SHIPPER')){
            if ($request->id_company != env('DEFAULT_INT')){

                $user->fk_shipper_id = $request->id_company;
            }else{
                $shipper = new Shipper();
                $shipper->company_name = $request->company_name;
                $shipper->address = $request->adresse;
                $shipper->phone = $request->user_phone;
                $shipper->email = $request->email;
                $shipper->city = $request->ville_company;

                $shipper->ifu = env('DEFAULT_INT');
                $shipper->rccm = env('DEFAULT_INT');
                $shipper->created_by = env('DEFAULT_INT');

                if ($request->type_company == env('DEFAULT_INT')){
                    $shipper->type = env('DEFAULT_INT');
                }elseif($request->type_company == env('STATUS_VALID')){
                    $shipper->type = env('STATUS_VALID');
                }
                $shipper->save();

                $user->fk_shipper_id = $shipper->id;
            }
        }


        try {
            Mail::to( $user->email)->send(new RegisterEmails($user->first_name,'Valider votre inscription',  $user->code));
            $user->save();
            return view('auth.verifyEmail');

        }catch (\Exception $e){
            return  redirect()->route('register');
        }
    }

    public function otpVerify(Request $request)
    {

        $request->validate([
            'otp' => ['required', 'string', 'max:255'],
        ]);

        $user = User::where('code', $request->otp)->first();

        $user = User::whereCode($request->otp)->first();

        if ($user && $user->code === $request->otp) {
            // Si le code OTP est vérifié, mettez le statut à 1
            $user->status = 1;
            $user->save();

            // Envoyez un e-mail pour informer de la vérification
            Mail::to($user->email)->send(new ValidatedRegisterEmails($user->first_name));

            return redirect()->route('index')->with('error', 'Le code OTP est incorrect.');

        } else {
            // Si le code OTP ne correspond pas alors le compte n'est pas vérifié, rediriger vers la page d'envoi de code OTP avec un message d'erreur

            return redirect()->route('verifyEmail')->with('error', 'Le code OTP est incorrect.');

            return redirect()->route('confirmation-email')->with('error_message', 'Le code OTP est incorrect.');
        }
    }

    public function codeRequest(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        //$user = User::firstOrCreate(['email' => $request->email]);


        // Vérifier si l'utilisateur existe
        if ($user) {
            // Générer un nouveau code OTP et l'associer à l'utilisateur
            $user->code = Helper::random_int(4, 9999);
            $user->save();

            // Envoyer le nouveau code OTP par e-mail
            Mail::to($user->email)->send(new RegisterEmails($user->first_name, 'Valider votre inscription', $user->code));

            return redirect()->route('verifyEmail')->with('error_message', 'Un nouveau code OTP a été envoyé.');
        }

        // Rediriger vers une page appropriée si l'utilisateur n'est pas trouvé
        return redirect()->route('verifyEmail')->with('error_message', 'Adresse e-mail non trouvée.');
    }


    public function getUserEntreprise()
    {
        if(Session::get('role') == env('ROLE_SHIPPER')){
            $user = User::find(intval(Session::get('userId')));

            if($user->status == env('STATUS_VALID') && $user->fk_shipper_id == env('DEFAULT_INT')){
                return response()->json('0');
            }
        }elseif(Session::get('role') == env('ROLE_CARRIER') ){
            $user = User::find(intval(Session::get('userId')));

            if($user->status == env('STATUS_VALID')&& $user->fk_carrier_id == env('DEFAULT_INT')){
                return response()->json('0');
            }
        }
        return response()->json('1');
    }

    public function affectUserEntreprise($id)
    {
        if(Session::get('role') == env('ROLE_SHIPPER')){
            $user = User::find(intval(Session::get('userId')));
            $user->fk_shipper_id = intval($id);
            $user->save();
        }elseif(Session::get('role') == env('ROLE_CARRIER')){
            $user = User::find(intval(Session::get('userId')));
            $user->fk_carrier_id = intval($id);
            $user->save();
        }
        return response()->json('0');
    }

    public function updateSession(Request  $request)
    {
        $user = User::find(Session::get('userId'));
        $request->session()->put('status', $user->status);
        return session()->get('status');
    }

    public function getUserOne($id)
    {
        $user = User::find($id);
        if($user->fk_carrier_id != env('DEFAULT_INT')){
            $user->company =$user->carrier;
        }elseif ($user->fk_shipper_id != env('DEFAULT_INT')){
            $user->company =$user->shipper;
            $user->company->city = $user->company->ville;
        }

        return response()->json($user);
    }

    public function updateStatutUser($action,$id)
    {

        $user = User::find(intval($id));

        if($action == env('DEFAULT_INT')){
            $user->status = env('DEFAULT_VALID');
        }elseif($action == env('STATUS_VALID')){
            $user->status = env('STATUS_ADMIN');
        }elseif ($action == env('DEFAULT_VALID')){
            $user->status = env('STATUS_VALID');
        }


        $user->save();

        return response()->json('0');
    }

    public function updateUser(Request $request)
    {
        $user = User::find(intval($request->id_users));

        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->user_phone = $request->user_phone;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->role = $request->roles;
        if(empty($request->password)){
            $test = '';
        }
        elseif( !empty($request->password ) && !empty($request->cpassword ) ){
            if($request->password == $request->cpassword){
                $user->password =  Hash::make($request->password);
            }
        }
        else{
            return response()->json('1');
        }

        if($request->roles == env('ROLE_SHIPPER')){

            if( isset($request->structures) && $request->structures != env('DEFAULT_INT')){

                $user->fk_shipper_id = $request->structures;
            }
        }elseif ($request->roles == env('ROLE_CARRIER')){
            return response()->json('test1');

            if( isset($request->structures) && $request->structures != env('DEFAULT_INT')){
                $user->fk_carrier_id = $request->structures;
            }
        }
        $user->save();

        return response()->json('0');
    }

    public function deleteUser($id)
    {
        $user = User::find(intval($id));
        $user->delete();

        return response()->json('0');
    }


    public function getNotifications()
    {
        if(Session::get('role') == env('ROLE_SHIPPER')) {
            $notifs = Notification::where('status', '=', env('DEFAULT_INT'))
                ->orWhere('status', '=', Session::get('fk_shipper_id'))
                ->get();
        }
        elseif (Session::get('role')== env('ROLE_CARRIER')) {
            $notifs = Notification::where('status', '=', env('DEFAULT_INT'))
                ->orWhere('status', '=', Session::get(''))
                ->get();
        }elseif (Session::get('role')== env('ROLE_ADMIN')){
            $notifs = Notification::all();
        }

        return response()->json($notifs);
    }

    public function displayNotifications()
    {
        if(Session::get('role') == env('ROLE_SHIPPER')) {
            $notifs = Notification::where('status', '=', env('DEFAULT_INT'))
                ->orWhere('status', '=', Session::get('fk_shipper_id'))
                ->get();
            return view('pages.offer.notification', compact('notifs'));
        }
        elseif (Session::get('role')== env('ROLE_CARRIER')) {
            $notifs = Notification::where('status', '=', env('DEFAULT_INT'))
                ->orWhere('status', '=', Session::get(''))
                ->get();
            return view('pages.offer.notification', compact('notifs'));
        }elseif(Session::get('role')== env('ROLE_ADMIN')){
            $notifs = Notification::all();
            return view('pages.admin.notification', compact('notifs'));
        }
    }

    public function getProfil(){
        $user = User::find(intval(Session::get('userId')));
        if(Session::get('role') == env('ROLE_SHIPPER')){
            $user->company = $user->shipper;
            $user->verified = 'OUI';
            if ($user->email_verified == env('STATUS_VALID')){
                $user->verified = 'NON';
            }
        }elseif(Session::get('role') == env('ROLE_CARRIER')){
            $user->company = $user->carrier;
            $user->verified = 'OUI';
            if ($user->email_verified == env('STATUS_VALID')){
                $user->verified = 'NON';
            }
        }
        return view('auth.profil',compact('user'));
    }

    public function updateProfil(updateProfil $request)
    {

        $user = User::find(Session::get('userId'));
        $user->name =$request->input('name');
        $user->first_name =$request->input('first_name');
        $user->username =$request->input('username');
        $user->user_phone =$request->input('user_phone');
        $user->email =$request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->email_verified =$request->input('verified');
        $user->save();

        if(Session::get('role') == env('ROLE_SHIPPER')){
            $user->company = $user->shipper;
        }elseif(Session::get('role') == env('ROLE_CARRIER')){
            $user->company = $user->carrier;
        }
        return redirect()->route('getProfil')->with('success', "Utilisateur modifié avec succès");
    }
}
