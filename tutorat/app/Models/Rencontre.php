<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rencontre extends Model
{
    protected $fillable = ['tuteur_id', 'eleve_id', 'status', 'heure_debut', 'heure_fin'];

    public function tuteur()
    {
        return $this->belongsTo(Usager::class, 'tuteur_id');
    }

    public function eleve()
    {
        return $this->belongsTo(Usager::class, 'eleve_id');
    }
}
