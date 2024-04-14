<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = ['nomMatiere'];

    public function domaines()
    {
        return $this->belongsToMany(Domaine::class, 'matiere_domaine', 'matiere_id', 'domaine_id');
    }
    public function notes()
    {
        return $this->hasMany(NoteEtudiant::class, 'idMatiere');
    }
}
