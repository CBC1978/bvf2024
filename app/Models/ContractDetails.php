<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractDetails extends Model
{
    use HasFactory;

    protected $table = 'contract_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'driver_id',
        'contract_id',
        'cars_id',
        'created_by',
    ];
}
