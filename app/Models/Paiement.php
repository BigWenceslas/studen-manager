<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'tranche_1',
        'date_paiement_tranche_1',
        'tranche_2',
        'date_paiement_tranche_2',
        'annee_academique',
        'user_id',
    ];
}
