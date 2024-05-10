
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@extends('layouts.app')

@section('title', 'Recherche de tuteur')
@section('contenu')
<section class="main-container" >
    <h1>Recherche de tuteur</h1>

  
    <form action="{{ route('Tutorat.recherche') }}" method="POST">
        @csrf

        <label for="matiere">Sélectionner une matière :</label>
        <select name="matiere" id="matiere">
            @foreach($matieres as $matiere)
                <option value="{{ $matiere->id }}">{{ $matiere->nomMatiere }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-info">Rechercher</button>
    </form>
</section>
@endsection
