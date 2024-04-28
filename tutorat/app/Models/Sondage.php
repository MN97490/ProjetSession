<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sondage extends Model
{
    protected $fillable = ['titre', 'description', 'status', 'type', 'ratingSondage'];

    public function commentaires() {
        return $this->hasMany(Commentaire::class);
    }
}
