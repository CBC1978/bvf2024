<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\offer\publishForm;
use App\Mail\RegisterEmails;
use App\Models\FreightAnnouncement;
use App\Models\TransportAnnouncement;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\auth\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrier;
use App\Models\Shipper;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function displayEntrepriseChargeur()
    {

        $shippers = Shipper::all(); // Récupérer tous les expéditeurs
        $shippers->each(function ($obj){
            $obj->city = $obj->ville;
        });
        $villes = Ville::all();

//        echo '<pre>';
//        print_r ($shippers[0]->city->libelle);
//        echo '<pre>';
        return view('pages.admin.chargeur', compact('shippers', 'villes'));
    }

    public function getCarriers()
    {
        return Carrier::all();
    }
    public function getShippers()
    {
        return Shipper::all();
    }

    public function displayEntrepriseTransporteur()
    {
        $users = User::all();

        $carriers = Carrier::all(); // Récupérer tous les transporteurs
        $carriers->each(function ($obj){
            $obj->city = $obj->ville;
        });
        $villes = Ville::all();

        return view('pages.admin.transporteur', compact('users', 'carriers', 'villes'));
    }

    public function getCarrierUsers($id)
    {
        $users = User::where('fk_carrier_id','=', intval($id))->get();

        return view('pages.admin.transporteur_user', compact('users'));

    }

    //fonction pour la page du bouton voir plus
    public function voirplus($id){
        $selectedCarrier = Carrier::findOrFail($id);
        return view('pages.admin.voirPlusTrans', compact('selectedCarrier'));
    }
    public function assignEntrepriseToUser(Request $request)
    {
        // Récupérer les données du formulaire
        $selectedUsers = $request->input('selected_users');
        $carrierId = $request->input('carrier_id');
        $shipperId = $request->input('shipper_id');

        // Parcourir les utilisateurs sélectionnés
        foreach ($selectedUsers as $userId) {
            // Récupérer l'utilisateur en utilisant son ID
            $user = User::find(intval($userId));


            // Attribuer l'entreprise de transport s'il y a un transporteur sélectionné
            if (!empty($carrierId)) {
                $user->fk_carrier_id = intval($carrierId);
                $user->fk_shipper_id = 0;
                $user->save();
            }

            // Attribuer l'entreprise d'expédition s'il y a un expéditeur sélectionné
            if (!empty($shipperId)) {
                $user->fk_shipper_id = intval($shipperId);
                $user->fk_carrier_id = 0;
                $user->save();
            }
        }
    }

    public function addCarrier(Request $request)
    {
        // Récupérer l'ID de l'utilisateur depuis le champ hidden

        $validatedData = $request->validate([
            'company_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'max:255',
            'city' => 'required|string',
            'email' => 'required|email',
            'ifu' => 'required|string',
            'rccm' => 'required|string',
            'name_boss' => 'max:255',
        ]);

        // Ajouter l'ID de l'utilisateur
        $validatedData['created_by'] = Session::get('userId');
        $validatedData['statut_juridique'] = env('STATUS_VALID');
        // Créer un nouveau transporteur associé à l'utilisateur
        Carrier::create($validatedData);

        return redirect()->back()->with('success', 'Transporteur ajouté avec succès.');
    }
    //
    public function displayOfferShipper()
    {
        $chargeurAnnonces = FreightAnnouncement::with(['shipper','transportOffer'])->get();

        return view('pages.admin.admin_displayOfferShipper', compact('chargeurAnnonces'));
    }

    public function displayOfferTransporter()
    {
        $transporteurAnnonces = TransportAnnouncement::with(['carrier','freightOffer'])->get();

        return view('pages.admin.admin_displayOfferTransporter', compact('transporteurAnnonces'));

    }
    public function DisplayregisterAdmin(){

        return view('pages.admin.registerForAdmin');
    }

    public function AdminRegister(Request $request)
    {

        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'user_phone' => ['required', 'string', 'max:20'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required', 'string', 'in:admin'],
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->user_phone = $request->user_phone;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->code = Helper::random_int(4, 9999);
        $user->email = $request->email;
        $user->password =Hash::make( $request->password);
        $user->role = $request->role;
        $user->status = 3;
        try {

            Mail::to( $user->email)->send(new RegisterEmails($user->first_name,'Valider votre inscription',  $user->code));
            $user->save();
            return view('auth.verifyEmail');

        }catch (\Exception $e){

            return view('pages.admin.registerForAdmin');
        }
    }

    public function addShipper(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'company_name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'email' => 'required|email',
            'ifu' => 'required|string',
            'rccm' => 'required|string',
            'name_boss' => 'max:255',
            'phone' => 'max:255',
        ]);

        // Ajouter l'ID de l'utilisateur
        $validatedData['created_by'] = Session::get('userId');
        $validatedData['statut_juridique'] = env('STATUS_VALID');

        Shipper::create($validatedData);

        return redirect()->back()->with('success', 'Chargeur ajouté avec succès.');
    }

    public function displayProfile()
    {
        if (session()->has('username')) {
            $username = session('username');
            $user = User::where('username', $username)->first(); // Recherchez l'utilisateur par son nom d'utilisateur

            if ($user) {
                return view('pages.admin.profile.a_profile', compact('user'));
            }
        }
    }

    public function updateUserProfile(Request $request)
    {
        // Validez les données respect de consigne pur chaque champ
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'user_phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);


        // retrouver l'utilisateur en question
        $username = session('username');
        $user = User::where('username', $username)->first();

        if ($user) {
            // Mis à jour données...
            $user->update([
                'name' => $request->input('name'),
                'first_name' => $request->input('first_name'),
                'username' => $request->input('username'),
                'user_phone' => $request->input('user_phone'),
                'email' => $request->input('email'),
            ]);

            return redirect()->route('admin.profile.affichage')->with('success', 'donnéés mise à jour avec succès.');
        }
    }

    public function affichage()
    {
        if (session()->has('username')) {
            $username = session('username');
            $user = User::where('username', $username)->first(); // Je recherche l'utilisateur par son nom d'utilisateur

            if ($user) {
                return view('pages.admin.profile.a_profile', compact('user'));
            }
        }
    }

    public function update(Request $request)
    {
        // Validez les données respect de consigne pur chaq champ
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'user_phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'company_name' => 'required|string|max:255',
        ]);

        // retrouver le user en question
        $username = session('username');
        $user = User::where('username', $username)->first();

        if ($user) {
            // Mis à jour données...
            $user->update([
                'name' => $request->input('name'),
                'first_name' => $request->input('first_name'),
                'username' => $request->input('username'),
                'user_phone' => $request->input('user_phone'),
                'email' => $request->input('email'),
                'company_name' => $request->input('company_name'),
            ]);

            return redirect()->route('admin.profile.affichage')->with('success', 'donnéés mise à jour avec succès.');
        }
    }

    public function getCarrierOne($id)
    {
         $carrier = Carrier::find(intval($id));
         $carrier->city = $carrier->ville;

         return $carrier;
    }

    public function updateCarrier(Request  $request)
    {
        $carrier = Carrier::find(intval($request->id_carrier));

        $carrier->company_name = $request->company_name;
        $carrier->address = $request->address;
        $carrier->phone = $request->phone;
        $carrier->city = $request->city_up;
        $carrier->email = $request->email;
        $carrier->ifu = $request->email;
        $carrier->rccm = $request->email;

        $carrier->save();
        return redirect()->route('transporteur')->with('success', 'Trasnporteur modifié avec succès.');
    }

    public function assignCarrierUsers($id)
    {
        $user = User::find(intval($id));

        $user->status = env('DEFAULT_VALID');
        $user->save();

        return response()->json('0');
    }

    public function getShipperOne($id)
    {

        $shipper = Shipper::find(intval($id));
        $shipper->city = $shipper->ville;

        return $shipper;
    }

    public function updateShipper(Request $request)
    {
        $shipper = Shipper::find(intval($request->id_shipper));

        $shipper->company_name = $request->company_name;
        $shipper->address = $request->address;
        $shipper->phone = $request->phone;
        $shipper->city = $request->city_up;
        $shipper->email = $request->email;
        $shipper->ifu = $request->email;
        $shipper->rccm = $request->email;
        $shipper->name = $request->name;

        $shipper->save();
        return redirect()->route('chargeur')->with('success', 'Chargeur modifié avec succès.');

    }

    public function getShipperUsers($id)
    {
        $users = User::where('fk_shipper_id','=', intval($id))->get();

        return view('pages.admin.chargeur_user', compact('users'));
    }

}
