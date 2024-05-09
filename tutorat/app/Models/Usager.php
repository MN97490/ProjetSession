<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Usager extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'nomUtilisateur',
        'nom',
        'prenom',
        'email',
        'role',
        'is_tuteur',
        'presence',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function domaineEtude()
{
    return $this->belongsTo(Domaine::class, 'domaineEtude');
}

public function notes()
{
    return $this->hasMany(Note::class, 'idCompte');
}

public function disponibilites()
{
    return $this->hasMany(Disponibilite::class, 'usager_id');
}
public function demandes()
{
    return $this->hasMany(Demande::class);
}


public function matieresAutorisees()
{
    return $this->belongsToMany(Matiere::class, 'matieres_tuteur', 'usager_id', 'matiere_id');
}

public function conversations()
{
    return $this->hasMany(Conversation::class, 'user1')->orWhere('user2', $this->id);
}

public function aides()
{
    return $this->hasMany(Aide::class, 'user');
}


}
