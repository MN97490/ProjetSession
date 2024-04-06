<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usager extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'nomUtilisateur',
        'nom',
        'prenom',
        'matiere',
        'email',
        'type',
        'is_tuteur'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
