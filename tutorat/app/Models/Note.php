<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'idMatiere',
        'idCompte',
        'Note'
        
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'idMatiere');
    }

    public function usager()
    {
        return $this->belongsTo(Usager::class, 'idCompte');
    }
}
