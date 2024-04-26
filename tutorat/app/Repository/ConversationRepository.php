<?php
namespace App\Repository;

class ConversationRepository{

    public function __construct(Usager $user){
        $this->user=$user;
    }

    public function getConversation(int $userId){
        $this->user->newQuery()
        ->$users = Usager::all() 
        -> where('id','!=',$userId)
        ->get();


    }
}