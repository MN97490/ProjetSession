<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = ['usager_id', 'motivation', 'statut','motif'];

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'demande_matiere');
    }
}
