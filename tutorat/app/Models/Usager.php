<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usager extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'nomUtilisateur',
        'nom',
        'prenom',
        'domaineEtude',
        'email',
        'role',
        'is_tuteur'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
