<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}

