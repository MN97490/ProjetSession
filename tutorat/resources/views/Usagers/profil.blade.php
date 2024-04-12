@extends('layouts.app')
@section('title', "Profil")
@section('contenu')

<section class="main-container" >
<h1 class="text-center">Page profil de @auth {{ Auth::user()->nomUtilisateur }} @endauth</h1>
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




    

            



            </div>
          <button type="submit" class="btn btn-primary" >Modifier les informations</button>
  
        </div>      
</form>
@endsection