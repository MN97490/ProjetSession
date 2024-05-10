<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    use HasFactory;

    protected $fillable = [
        'jour',
        'start', 
        'end',   
        'usager_id',
    ];

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }
}
