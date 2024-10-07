<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportAnnouncement extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'transport_announcement';

    protected $fillable = [
        'fk_carrier_id',
        'origin',
        'destination',
        'price',
        'duration',
        'type_price',
        'limit_date',
        'description',
        'created_by',
    ];

    public function carrier()
    {
        return $this->belongsTo(Carrier::class, 'fk_carrier_id');
    }

    public function freightOffer()
    {
        return $this->hasMany(FreightOffer::class, 'fk_transport_announcement_id');
    }

    public function originOffer()
    {
        return $this->belongsTo(Ville::class, 'origin','id');
    }

    public function transportCar()
    {
        return $this->hasMany(TransportCar::class, 'fk_transport','id');
    }

    public function destinationOffer()
    {
        return $this->belongsTo(Ville::class, 'destination', 'id');
    }

}
