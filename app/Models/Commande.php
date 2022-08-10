<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'nombreColis',
        'poids',
        'dateEnregistrement',
        'lieuDepart',
        'lieuDestination',
        'Description',
        'uploadPhoto',
        'residenceAdresse',
        'envoyeur_id',
        'livreur_id',
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class);
    }
}