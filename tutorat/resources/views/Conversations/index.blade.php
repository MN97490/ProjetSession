@extends('layouts.app')

@section('title', 'Mes Conversations')

@section('contenu')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<section class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-5">
                <h1 class="text-center mb-4">Créer une nouvelle conversation</h1>
                <div class="card shadow-sm p-4">
                    <form action="{{ route('conversations.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user2" class="form-label">Sélectionnez un utilisateur :</label>
                            <select name="user2" id="user2" class="form-select">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Commencer la conversation</button>
                        </div>
                    </form>
                </div>
            </div>

            <h2 class="text-center mb-4">Vos conversations :</h2>
            @if($conversations->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    Aucune conversation disponible. Commencez à discuter dès que l'envie vous prend!
                </div>
            @else
                <div class="list-group">
                    @foreach($conversations as $conversation)
                        <a href="{{ route('Conversations.zoom', $conversation->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $conversation->getOtherUserName() }}
                            <span class="badge bg-primary rounded-pill">Message</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    
</section>
@endsection
