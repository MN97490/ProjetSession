@extends('layouts.app')

@section('title', 'Ma Rémunération')

@section('contenu')
    <h1>Ma Rémunération des Deux Dernières Semaines</h1>
    @if($rencontresCount > 0)
        <p>Le total de votre rémunération est de : ${{ $totalRemuneration }}</p>
    @else
        <p>Vous n'avez pas de rencontre terminée depuis les deux dernières semaines.</p>
    @endif

    <h1>Ma Rémunération du mois</h1>
    @if($rencontresCountM > 0)
        <p>Le total de votre rémunération est de : ${{ $totalRemunerationM }}</p>
    @else
        <p>Vous n'avez pas de rencontre terminée depuis les quatre dernières semaines.</p>
    @endif

    <h1>Ma Rémunération de {{$year}} </h1>
    @if($rencontresCountY > 0)
        <p>Le total de votre rémunération est de : ${{ $totalRemunerationY}}</p>
    @else
        <p>Vous n'avez pas de rencontre terminée depuis les quatre dernières semaines.</p>
    @endif
@endsection
