@extends('layouts.app')

@section('title', 'Modifier la demande')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@section('contenu')

<br><br>


    <h1>Modifier la demande</h1>
    <form action="{{ route('demande.update', $demande->id) }}" style="padding: 10px" method="POST">
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

        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
@endsection
