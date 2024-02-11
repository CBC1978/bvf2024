<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'registration',
        'fk_type_car',
        'fk_brand_car',
        'model',
        'payload',
        'image',
        'fk_carrier_id',
    ];


    public function type()
    {
        return $this->belongsTo(TypeCar::class, 'fk_type_car', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(BrandCar::class, 'fk_brand_car', 'id');
    }
}
