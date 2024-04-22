<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    use HasFactory;

    protected $fillable = [
        'jour',
        'start', // Changer 'heure_debut' en 'start'
        'end',   // Changer 'heure_fin' en 'end'
        'usager_id',
    ];

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }
}
