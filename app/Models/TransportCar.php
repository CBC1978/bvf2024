<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class TransportCar extends Model
    {
        use HasFactory;
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $table = 'transport_car';

        protected $fillable = [
            'fk_transport',
            'fk_car',
            'qte',
        ];

        public function Cars()
        {
            return $this->belongsTo(Car::class, 'fk_car');
        }
    }
