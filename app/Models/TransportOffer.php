<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportOffer extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'transport_offer';

    protected $fillable = [
        'fk_freight_announcement_id',
        'fk_carrier_id',
        'price',
        'description',
        'status',
        'created_by',
    ];

    /**
     * Get the freight announcement associated with the transport offer.
     */
    public function FreightAnnouncement()
    {
        return $this->belongsTo(FreightAnnouncement::class, 'fk_freight_announcement_id');
    }

    /**
     * Get the carrier associated with the transport offer.
     */
    public function Carrier()
    {
        return $this->belongsTo(Carrier::class, 'fk_carrier_id');
    }
}
