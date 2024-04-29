@extends('layouts.app')

@section('title', 'Mes Conversations')

@section('contenu')
<section class="main-container">

    <h1>Créer une nouvelle conversation</h1>
    <form action="{{ route('conversations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user2" class="form-label">Sélectionnez un utilisateur :</label>
            <select name="user2" id="user2" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Commencer la conversation</button>
    </form>
    
    @if($conversations->isEmpty())
        <p>Aucune conversation disponible. Commencez à discuter dès que l'envie vous prend!</p>
    @else
        @foreach($conversations as $conversation)
            <div>
              
                <a href="{{ route('Conversations.zoom', $conversation->id) }}"> {{ $conversation->getOtherUserName()}}</a>
                   
              
            </div>
        @endforeach
    @endif
    
</section>
@endsection
