@extends('layouts.app')
@section('title', "Profil de {$usager->nom} {$usager->prenom}")
@section('contenu')

<section class="main-container">
    <h2>Profil de {{ $usager->nom }} {{ $usager->prenom }}</h2>
    <p><strong>Nom d'utilisateur:</strong> {{ $usager->nomUtilisateur }}</p>
    <p><strong>Nom:</strong> {{ $usager->nom }}</p>
    <p><strong>Prénom:</strong> {{ $usager->prenom }}</p>
    <p><strong>Domaine d'étude:</strong> {{ $domaine->nomDomaine }}</p>
    @if($usager->is_tuteur)
        <p><strong>Statut:</strong> Tuteur</p>
    @endif
    <button>Envoyer un message</button> 
</section>

@endsection
