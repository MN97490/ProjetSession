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
                        <button>Réserver</button>
                    </li>
                @endforeach
            @endforeach
        </ul>
    @endif
@endsection
