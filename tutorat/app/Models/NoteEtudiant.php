<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteEtudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'idMatiere',
        'idCompte',
        'Note'
        
    ];
}
