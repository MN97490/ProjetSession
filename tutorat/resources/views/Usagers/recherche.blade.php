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
                @if($usager->id !== Auth::id())
                    <li>
                        <strong>{{ $usager->nom }} {{ $usager->prenom }}</strong>
                        <span>Rôle(s) : {{ $usager->role }}</span>
                        <a href="" class="btn-profil">Voir le profil</a>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif




<style>

.usagers-list {
    list-style-type: none;
    padding: 0;
}

.usagers-list li {
    margin-bottom: 10px;
}

.usagers-list li strong {
    font-weight: bold;
}

.usagers-list li span {
    font-style: italic;
    color: #666;
}

</style>


</section>

@endsection