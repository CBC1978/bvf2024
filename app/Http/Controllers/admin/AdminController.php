<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FreightAnnouncement;
use App\Models\TransportAnnouncement;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
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
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'first_name' => ['required', 'string', 'max:255'],
        'user_phone' => ['required', 'string', 'max:20'],
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'string', 'in:admin,chargeur,transporteur'],
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->first_name = $request->first_name;
    $user->user_phone = $request->user_phone;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->role = $request->role; 
    $user->status = 1;
    $user->save();

    return redirect()->route('DisplayregisterAdmin')->with('success_message', 'Un nouveau admin ajouté.');
}



}
