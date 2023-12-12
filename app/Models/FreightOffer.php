<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreightOffer extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'freight_offer';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    protected $fillable = [
        'fk_transport_announcement_id',
        'fk_shipper_id',
        'price',
        'weight',
        'description',
        'statut',
        'created_by',
    ];

    public function Carrier()
    {
        return $this->belongsTo(Carrier::class, 'fk_carrier_id');
    }

    public function transportAnnounce()
    {
        return $this->belongsTo(TransportAnnouncement::class, 'fk_transport_announcement_id');
    }

    public function Shipper()
    {
        return $this->belongsTo(Shipper::class, 'fk_shipper_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
