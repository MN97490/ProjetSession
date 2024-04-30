<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aide extends Model
{
    protected $fillable = ['user', 'texte'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(Usager::class, 'user');
    }
}
