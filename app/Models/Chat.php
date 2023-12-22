<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chat';

    protected $fillable = [
        'message',
        'status',
        'fk_offer_id',
        'fk_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id','id');
    }
}
