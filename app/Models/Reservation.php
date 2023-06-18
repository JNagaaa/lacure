<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'timeslot_id',
        'table_id',
        'field_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
