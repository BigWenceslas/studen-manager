<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil_academique extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_ue',
        'intitule_ue',
        'code_ec',
        'intitule_ec',
        'code_etape',
        'intitule_etape',
        'note_cc',
        'note_ex',
        'moyenne',
        'session',
        'decision'
    ];
}
