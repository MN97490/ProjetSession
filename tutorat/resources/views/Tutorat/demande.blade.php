@extends('layouts.app')
@section('title', "Devenir Tuteur")
@section('contenu')
<h1>Devenir Tuteur dans votre programme {{ $nomDomaine }}</h1>
<section class="main-container" >
    <form action="">
        @csrf

        <label for="matiere">Sélectionnez les matières :</label><br>
        @foreach($matieress as $matiere)
            <input type="checkbox" name="matieres[]" value="{{ $matiere->id }}" id="matiere{{ $matiere->id }}">
            <label for="matiere{{ $matiere->id }}">{{ $matiere->nomMatiere }}</label><br>
        @endforeach
        
        <br><br>
        <label for="motivation">Décrire vos motivations pour devenir Tuteur :</label><br>
        <textarea name="motivation" style="width: 400px; height: 100px;"></textarea>
        <br><br>
        <button type="submit">Soumettre</button>
    </form>
</section>
@endsection
