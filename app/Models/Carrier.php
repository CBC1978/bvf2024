<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'carrier';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'address',
        'phone',
        'city',
        'email',
        'type',
        'ifu',
        'rccm',
        'created_by',

    ];

    public function users()
    {
        return $this->hasMany(User::class, 'fk_carrier_id');
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'city');
    }
}
