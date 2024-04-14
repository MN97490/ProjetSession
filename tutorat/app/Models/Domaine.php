<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;

    protected $fillable = ['nomDomaine'];

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'matiere_domaine', 'domaine_id', 'matiere_id');
    }
}
