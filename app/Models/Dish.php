<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'image',
        'type_id',
        'description',
        'price',
    ];

    public function type()
    {
        return $this->belongsTo(DishType::class, 'type_id');
    }
}
