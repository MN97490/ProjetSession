@extends('layouts.app')
@section('title', "Recherche usager ")
@section('contenu')

<section class="main-container">
    <h2>Résultats de la recherche</h2>

    @if($usagers->isEmpty())
        <p>Aucun utilisateur trouvé.</p>
    @else
        <ul class="usagers-list">
            @foreach($usagers as $usager)
                @if($usager->id !== Auth::id() && !(Auth::user()->role === 'eleve' && $usager->role === 'admin'))
                    <li>
                        <strong><strong style="color: black">Prenom:</strong> {{ $usager->prenom }} <strong style="color: black">Nom:</strong> {{ $usager->nom }}</strong>
                        <span>Rôle(s) : {{ $usager->role }}</span>
                        <a href="{{ route('Usagers.zoom', $usager->id) }}" class="btn-profil">Voir le profil</a>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
</section>

<style>
.usagers-list {
    list-style-type: none;
    padding: 0;
}

.usagers-list li {
    margin-bottom: 10px;
    color: blue;
}

.usagers-list li strong {
    font-weight: bold;
}

.usagers-list li span {
    font-style: italic;
    color: #666;
}
</style>

@endsection
