<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    // Los campos que se pueden asignar masivamente
    protected $fillable = [
        'card_number', 'card_type', 'bank_name', 'limit', 'dni', 'first_name', 'last_name',
    ];

    // Desactivar los timestamps si no los necesitas
    public $timestamps = true;
}
