@extends('layouts.app')

@section('title', "Page gestion des sondages")

@section('contenu')
<section class="main-container">
    <h1>Gestion des Sondages</h1>
    <form action="{{ route('Sondages.create') }}" method="get">
        <button class="btn btn-success">Créer un Nouveau Sondage </button>
    </form>
   

    <h2>Sondages En Cours</h2>
    @foreach($sondagesEnCours as $sondage)
        <div>
            <p>{{ $sondage->titre }} - {{ $sondage->description }} - {{ $sondage->status }} -   {{ $sondage->type }}</p>
            <a href="{{ route('Sondages.edit', $sondage->id) }}" class="btn btn-primary">Modifier</a>
            <form action="{{ route('Sondages.destroy', $sondage->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    @endforeach

    <h2>Sondages Terminés</h2>
    @foreach($sondagesTermines as $sondage)
        <div>
            <p>{{ $sondage->titre }} - {{ $sondage->description }} - Type: {{ $sondage->type }}
                @if($sondage->type === 'evaluation')
                    - Rating: {{ $sondage->ratingSondage ?? 'Non évalué' }}
                @endif
            </p>
            <a href="{{ route('Sondages.show', $sondage->id) }}" class="btn btn-info">Voir Sondage</a>
            <form action="{{ route('Sondages.destroy', $sondage->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    @endforeach
</section >
@endsection
