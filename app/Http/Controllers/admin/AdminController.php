<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FreightAnnouncement;
use App\Models\TransportAnnouncement;

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

}
