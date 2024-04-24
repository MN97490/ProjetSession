@extends('layouts.app')

@section('title', 'Modifier la demande')

@section('contenu')
    <h1>Modifier la demande</h1>
    <form action="{{ route('demande.update', $demande->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="motivation">Motivation :</label><br>
        <textarea name="motivation" id="motivation" style="width: 400px; height: 100px;">{{ $demande->motivation }}</textarea>
        <br><br>

        <label for="matieres">Sélectionnez les matières :</label><br>
        @foreach($matieres as $matiere)
            <input type="checkbox" name="matieres[]" value="{{ $matiere->id }}" id="matiere{{ $matiere->id }}"
                   @if($demande->matieres->contains($matiere)) checked @endif>
            <label for="matiere{{ $matiere->id }}">{{ $matiere->nomMatiere }}</label><br>
        @endforeach
        <br><br>

        <button type="submit">Mettre à jour</button>
    </form>
@endsection
