<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Conversation extends Model
{
    protected $fillable = ['user1', 'user2'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function user1()
{
    return $this->belongsTo(Usager::class, 'user1');
}

public function user2()
{
    return $this->belongsTo(Usager::class, 'user2');
}

public function getOtherUserName()
{
    $user = Auth::user();

    if ($this->user1 == $user->id) {
        return Usager::findOrFail($this->user2)->nom . ' ' . Usager::findOrFail($this->user2)->prenom;
    } else {
        return Usager::findOrFail($this->user1)->nom . ' ' . Usager::findOrFail($this->user1)->prenom;
    }
}

}


