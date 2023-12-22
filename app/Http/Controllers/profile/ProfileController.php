<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function affichage()
    {
        if (session()->has('username')) {
            $username = session('username');
            $user = User::where('username', $username)->first();
            
            if ($user) {
                return view('pages.profile.profile', compact('user'));
            }
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'user_phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'company_name' => 'required|string|max:255',
        ]);

        $username = session('username');
        $user = User::where('username', $username)->first();

        if ($user) {
            $user->update([
                'name' => $request->input('name'),
                'first_name' => $request->input('first_name'),
                'username' => $request->input('username'),
                'user_phone' => $request->input('user_phone'),
                'email' => $request->input('email'),
                'company_name' => $request->input('company_name'),
            ]);

            $route = $user->fk_shipper_id ? 'shipper.profile.affichage' : 'carrier.profile.affichage';
            return redirect()->route($route)->with('success', 'Données mises à jour avec succès.');
        }
    }
}
