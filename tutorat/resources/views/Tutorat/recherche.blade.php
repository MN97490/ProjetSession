@extends('layouts.app')

@section('title', 'Liste des tuteurs pour ' . $nomMatiere)
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@section('contenu')
    <h1>Liste des tuteurs pour {{ $nomMatiere }}</h1>

    @if ($tuteurs->isEmpty())
        <p>Aucun tuteur disponible pour cette matière.</p>
    @else
        <ul>
            @foreach($tuteurs as $tuteur)
                @foreach ($tuteur->disponibilites as $disponibilite)
                    @php
                        $matches = $disponibilitesUtilisateur->filter(function ($userDispo) use ($disponibilite) {
                            return $userDispo->jour === $disponibilite->jour &&
                                   $userDispo->start === $disponibilite->start &&
                                   $userDispo->end === $disponibilite->end;
                        });
                    @endphp

                    @if($matches->isNotEmpty())
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
                    @endif
                @endforeach
            @endforeach
        </ul>
    @endif
@endsection
