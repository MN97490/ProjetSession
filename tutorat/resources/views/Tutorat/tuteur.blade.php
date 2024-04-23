<!-- resources/views/Tutorat/rechercher_tuteur.blade.php -->

@extends('layouts.app')

@section('title', 'Recherche de tuteur')

@section('contenu')
    <h1>Recherche de tuteur</h1>

    <!-- Formulaire de recherche -->
    <form action="{{ route('Tutorat.recherche') }}" method="POST">
        @csrf

        <label for="matiere">Sélectionner une matière :</label>
        <select name="matiere" id="matiere">
            @foreach($matieres as $matiere)
                <option value="{{ $matiere->id }}">{{ $matiere->nomMatiere }}</option>
            @endforeach
        </select>

        <button type="submit">Rechercher</button>
    </form>
@endsection
