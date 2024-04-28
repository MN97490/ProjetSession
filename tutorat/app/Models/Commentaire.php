<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = ['sondage_id', 'contenu'];

    public function sondage() {
        return $this->belongsTo(Sondage::class);
    }
}
