<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationUser extends Model
{
    use HasFactory;

    protected $table = "reservation_user";

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'reservation_id',
    ];

}