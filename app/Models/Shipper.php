<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shipper';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'address',
        'phone',
        'city',
        'email',
        'statut_juridique',
        'ifu',
        'rccm',
        'name',
        'created_by',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'fk_shipper_id');
    }
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'city');
    }
}
