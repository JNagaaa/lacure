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
        'phone',
        'comment',
        'section_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'reservation_user');
    }

    public function timeslot()
    {
        return $this->belongsTo(Timeslot::class, 'timeslot_id');
    }
}
