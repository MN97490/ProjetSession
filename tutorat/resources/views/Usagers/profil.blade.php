@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@section('title', "Profil")
@section('contenu')

<section class="main-container" >
<h1 class="text-center">Page profil de @auth {{ Auth::user()->nomUtilisateur }} @endauth</h1>
<div class="container-fluid">
  <div class="row">
  <div class="col-4"> </div>
  <div class="col-4"style="justify-content: center">
<form method="GET" action="{{route('Usagers.modifier')}}" >
@csrf
<div class="form-group">
        <label for="nomUtilisateurUsager">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="nomUtilisateurUsager" value="{{ $usager->nomUtilisateur }}" readonly><br/>


        <label for="adresseCourrielUsager">Adresse courriel</label>
        <input type="text" class="form-control" id="adresseCourrielUsager" value="{{ $usager->email }}" readonly><br/>

        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" id="prenomUsager" value="{{ $usager->prenom }}" readonly  ><br/>

        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nomUsager" value="{{ $usager->nom }}" readonly  ><br/>

        <label for="motDePasse">Mot de passe</label>
        <input type="text" class="form-control" id="motDePasseUsager" value="*******" readonly  ><br/>
        <label for="presence">Présence :</label><br/>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="presence" id="presentiel" value="presentiel" {{ $usager->presence == 'presentiel' ? 'checked' : '' }} disabled>
            <label class="form-check-label" for="presentiel">Présentiel</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="presence" id="distanciel" value="distanciel" {{ $usager->presence == 'distanciel' ? 'checked' : '' }}disabled>
            <label class="form-check-label" for="distanciel">Distanciel</label>
        </div><br/><br/>

        <button type="submit" class="btn btn-primary" >Modifier les informations</button>
  
        </div>      
  </form>
  <div class="col-4"></div>
</div>
</div>
  </div>
  @role('eleve')
  @foreach($matieres as $matiere)
    <form method="POST" action="{{ route('updateNote', ['note' => $notes[$matiere->id]->id]) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir modifier cette note ?')">
        @csrf
        @method('PUT')
        <label>{{ $matiere->nomMatiere }}</label>
        <input type="hidden" name="idMatiere" value="{{ $matiere->id }}">
        <input type="hidden" name="idCompte" value="{{ Auth::user()->id }}">
        <input type="number" name="Note"  min="0" max="100" value="{{ $notes[$matiere->id]['Note'] }}">
        <button type="submit">Enregistrer</button>

    </form>

  @endforeach


@endrole
@endsection
