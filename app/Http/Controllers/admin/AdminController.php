<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;

use App\Models\FreightAnnouncement;
use App\Models\TransportAnnouncement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrier;
use App\Models\Shipper;
use App\Models\User;

class AdminController extends Controller
{
    public function displayEntrepriseChargeur()
    {
        $users = User::all();

        // $carriers = Carrier::all(); // Récupérer tous les transporteurs
        $shippers = Shipper::all(); // Récupérer tous les expéditeurs

        return view('pages.admin.chargeur', compact('users', 'shippers'));

    }

    public function displayEntrepriseTransporteur()
    {
        $users = User::all();

        $carriers = Carrier::all(); // Récupérer tous les transporteurs
        // $shippers = Shipper::all(); // Récupérer tous les expéditeurs

        return view('pages.admin.transporteur', compact('users', 'carriers'));
        

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
        $userId = $request->input('user_id');

        $validatedData = $request->validate([
        'company_name' => 'required|string',
        'address' => 'required|string',
        'phone' => 'required|string',
        'city' => 'required|string',
        'email' => 'required|email',
        'ifu' => 'required|string',
        'rccm' => 'required|string',

    ]);

        // Ajouter l'ID de l'utilisateur
        $validatedData['created_by'] = $userId;
        // Créer un nouveau transporteur associé à l'utilisateur
        Carrier::create($validatedData);

        return redirect()->back()->with('success', 'Transporteur ajouté avec succès.');
        // Renvoyer une réponse JSON avec le message de succès
        return Response::json(['message' => 'Transporteur ajouté avec succès.']);
        

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

    

    public function addShipper(Request $request)
    {
        // Récupérer l'ID de l'utilisateur à partir de la session

        $userId = $request->input('user_id');

        // Valider les données du formulaire
        $validatedData = $request->validate([
            'company_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'city' => 'required|string',
            'email' => 'required|email',
            'ifu' => 'required|string',
            'rccm' => 'required|string',

    ]);
        // Ajouter l'ID de l'utilisateur
        $validatedData['created_by'] = $userId;

        Shipper::create($validatedData);

        return redirect()->back()->with('success', 'Expéditeur ajouté avec succès.');

    }


//-------------------------profil
    public function displayProfile(){
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
        // Validez les données respect de consigne pur chaq champ
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'user_phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
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
            ]);
    
            return redirect()->route('admin.profile.affichage')->with('success', 'donnéés mise à jour avec succès.');
        }
    }


    public function affichage(){
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
}
