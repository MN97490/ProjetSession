@extends('layouts.app')

@section('title', 'Liste des tuteurs pour '.$nomMatiere)

@section('contenu')
    <h1>Liste des tuteurs pour {{ $nomMatiere }}</h1>

    @if ($tuteurs->isEmpty())
        <p>Aucun tuteur disponible pour cette matière.</p>
    @else
        <ul>
            @foreach($tuteurs as $tuteur)
                @foreach ($tuteur->disponibilites as $disponibilite)
                    <li>
                        Nom d'utilisateur : {{ $tuteur->nomUtilisateur }}, 
                        Nom : {{ $tuteur->nom }}, 
                        Prénom : {{ $tuteur->prenom }}, 
                        Jour : {{ $disponibilite->jour }},
                        Heure de début : {{ $disponibilite->start }},
                        Heure de fin : {{ $disponibilite->end }},
                        <form method="POST" action="{{ route('rencontres.store') }}">
                            @csrf
                            <input type="hidden" name="tuteur_id" value="{{ $tuteur->id }}">
                            <input type="hidden" name="eleve_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="heure_debut" value="{{ $disponibilite->start }}">
                            <input type="hidden" name="heure_fin" value="{{ $disponibilite->end }}">
                            <input type="hidden" name="tuteur_disponibilite_id" value="{{ $disponibilite->id }}">
                            <button type="submit">Réserver</button>
                        </form>
                    </li>
                @endforeach
            @endforeach
        </ul>
    @endif
@endsection
