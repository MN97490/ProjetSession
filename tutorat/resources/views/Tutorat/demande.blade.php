@extends('layouts.app')

@section('title', "Devenir Tuteur")
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@section('contenu')
<br><br>

    <h1>Devenir Tuteur dans votre programme {{ $nomDomaine }}</h1>
    <section class="main-container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('Tutorat.devenirTuteur') }}">
            @csrf

            <label for="matieres">Sélectionnez les matières :</label><br>
            @foreach($matieres as $matiere)
                <input type="checkbox" name="matieres[]" value="{{ $matiere->id }}" id="matiere{{ $matiere->id }}">
                <label for="matiere{{ $matiere->id }}">{{ $matiere->nomMatiere }}</label><br>
            @endforeach
            
            <br><br>
            <label for="motivation">Décrire vos motivations pour devenir Tuteur :</label><br>
            <textarea name="motivation" style="width: 400px; height: 100px;"></textarea>
            <br><br>
            <button type="submit" class="btn btn-success">Soumettre</button>
        </form>

        <h2>Demandes en cours</h2>
        <div class="demandes">
            @if ($demandes->where('statut', 'en cours')->isEmpty())
                <p>Vous n'avez aucune demande en cours.</p>
            @else
                @foreach($demandes->where('statut', 'en cours') as $demande)
                    <div class="demande">
                        <h3>Demande #{{ $demande->id }}</h3>
                        <p>Motivation : {{ $demande->motivation }}</p>
                        <p>Matières :</p>
                        <ul>
                            @foreach($demande->matieres as $matiere)
                                <li>{{ $matiere->nomMatiere }}</li>
                            @endforeach
                        </ul>
                        <p>Statut : {{ $demande->statut }}</p>
                        @if ($demande->statut === 'en cours')
                            <a href="{{ route('Tutorat.demandeedit', $demande->id) }}" class="btn btn-info">Modifier la demande</a>
                            
                            <form method="POST" action="{{ route('Tutorat.demande.destroy', $demande->id) }}" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">Supprimer la demande</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        <h2>Historique des demandes</h2>
        <div class="historique-demandes">
            @if ($historique->isEmpty())
                <p>Il n'y a pas d'historique de demandes.</p>
            @else
                @foreach($historique as $demande)
                    <div class="demande">
                        <h3>Numéro de Demande #{{ $demande->id }}</h3>
                        <p>Motivation : {{ $demande->motivation }}</p>
                        <p>Matières :</p>
                        <ul>
                            @foreach($demande->matieres as $matiere)
                                <li>{{ $matiere->nomMatiere }}</li>
                            @endforeach
                        </ul>
                        <p>Statut : {{ $demande->statut }}</p>
                        @if ($demande->statut === 'refuser')
                            <p>Motif du refus : {{ $demande->motif }}</p>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection
