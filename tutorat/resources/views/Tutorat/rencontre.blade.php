@extends('layouts.app')

@section('title', "Rencontre")

@section('contenu')
    <h1>Mes Rencontres</h1>
    
    @if($rencontres->isEmpty())
        <p>Aucune rencontre planifiée.</p>
    @else
        <h2>Rencontres à venir</h2>
        <ul>
            @foreach($rencontres->where('status', 'à venir') as $rencontre)
                <li>
                    Rencontre avec {{ $rencontre->tuteur_id == auth()->id() ? $rencontre->eleve->nom : $rencontre->tuteur->nom }}
                    le {{ $rencontre->heure_debut }} à
                    {{ $rencontre->heure_fin }} <strong>status: {{ $rencontre->status}}</strong>
                    <form method="POST" action="{{ route('rencontres.destroy', $rencontre->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette rencontre ?');">Annuler</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <h2>Rencontres terminées</h2>
        <ul>
            @foreach($rencontres->where('status', 'terminé') as $rencontre)
                <li>
                    Rencontre avec {{ $rencontre->tuteur_id == auth()->id() ? $rencontre->eleve->nom : $rencontre->tuteur->nom }}
                    le {{ $rencontre->heure_debut }} à
                    {{ $rencontre->heure_fin }} <strong>status: {{ $rencontre->status}}</strong>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
