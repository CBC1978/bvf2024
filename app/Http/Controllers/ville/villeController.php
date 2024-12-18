<?php

namespace App\Http\Controllers\ville;

use App\Http\Controllers\Controller;
use App\Models\Ville;
use Illuminate\Http\Request;


class villeController extends Controller
{
    public function getAllVille()
    {
        return Ville::all();


    }
}
