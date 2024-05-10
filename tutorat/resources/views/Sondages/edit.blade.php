@extends('layouts.app')

@section('title', 'Modifier Sondage')

@section('contenu')
@role('admin')
    <h1>Modifier Sondage</h1>
    <form action="{{ route('Sondages.update', $sondage->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="titre">Titre:</label>
        <input type="text" name="titre" id="titre" value="{{ $sondage->titre }}" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ $sondage->description }}</textarea>

        <label for="status">Statut:</label>
        <select name="status" id="status">
            <option value="en cours" {{ $sondage->status == 'en cours' ? 'selected' : '' }}>En cours</option>
            <option value="terminer" {{ $sondage->status == 'terminer' ? 'selected' : '' }}>Terminé</option>
        </select>
        
        <label for="type">Type de Sondage:</label>
    <select name="type" id="type">
        <option value="question" {{ $sondage->type == 'question' ? 'selected' : '' }}>Question</option>
        <option value="evaluation" {{ $sondage->type == 'evaluation' ? 'selected' : '' }}>Évaluation</option>
    </select>

        <button type="submit">Mettre à jour</button>
    </form>
    @else
    <script>window.location = "{{ route('Tutorat.index') }}";</script>


@endrole
@endsection
