<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsagerRequest;
use Auth;
use Log;

use App\Models\Usager;
use Illuminate\Support\Facades\Hash;
use App\Models\Domaine;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Disponibilite;
use App\Models\Conversation;
use App\Models\Message;


class ConversationsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

    // Utilisation de la relation 'conversations' définie dans le modèle Usager
    $conversations = $user->conversations()->with('user1', 'user2')->get();

    // Récupérer d'autres utilisateurs pour la création de nouvelles conversations
    $users = Usager::where('id', '!=', $user->id)->get();

    return view('Conversations.index', compact('conversations', 'users'));

    }
    

    public function store(Request $request)
{
    $request->validate([
        'user2' => 'required|integer|exists:usagers,id'
    ]);

  
    $user1 = Auth::user();
    $user2 = $request->input('user2');

  
    if ($user1 == $user2) {
        return back()->with('error', 'Vous ne pouvez pas créer une conversation avec vous-même.');
    }

    
    $existingConversation = Conversation::where(function ($query) use ($user1, $user2) {
        $query->where('user1', $user1)->where('user2', $user2);
    })->orWhere(function ($query) use ($user1, $user2) {
        $query->where('user1', $user2)->where('user2', $user1);
    })->first();

    if ($existingConversation) {
        return redirect()->route('Conversations.index', $existingConversation->id)
                         ->with('info', 'Une conversation existe déjà avec cet utilisateur.');
    }

  
    $conversation = new Conversation([
        'user1' => $user1->id,
        'user2' => $user2
    ]);
    $conversation->save();

    return redirect()->route('Conversations.index', $conversation->id)
                     ->with('success', 'Conversation créée avec succès.');
}

    
}
