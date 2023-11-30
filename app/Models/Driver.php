<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'driver';

    protected $fillable = [
        'first_name',
        'last_name',
        'licence',
        'date_issue',
        'place_issue',
        'fk_carrier_id',
        'created_by',
    ];
}
