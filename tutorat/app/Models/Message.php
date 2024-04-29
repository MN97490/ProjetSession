<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['conversation_id', 'userfrom', 'texte','created_at' ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender()
    {
        return $this->belongsTo(Usager::class, 'userfrom');
    }

    public function getSenderName()
    {
        return $this->sender->nom . ' ' . $this->sender->prenom;
    }
  
}
