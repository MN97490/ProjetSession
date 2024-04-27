@extends('layouts.app')

@section('title', 'Ma Rémunération')

@section('contenu')
    <h1>Ma Rémunération des Deux Dernières Semaines</h1>
    @if($rencontresCount > 0)
        <p>Le total de votre rémunération est de : ${{ $totalRemuneration }}</p>
    @else
        <p>Vous n'avez pas de rencontre terminée depuis les deux dernières semaines.</p>
    @endif
@endsection
