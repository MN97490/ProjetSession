@extends('layouts.app')
@section('title', "Profil")
@section('contenu')


<section class="main-container" >
<h1 class="text-center">Page modification profil de @auth {{ Auth::user()->nomUtilisateur }} @endauth</h1>
<form method="POST" action="{{{route('Usagers.update', [$usager]) }}}" >
@csrf
@method('PATCH')
<div class="form-group">
        <label for="nomUtilisateurUsager">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="nomUtilisateurUsager" value="{{ old('nomUtilisateur', $usager->nomUtilisateur) }}" name="nomUtilisateur"><br/>


        <label for="adresseCourrielUsager">Adresse courriel</label>
        <input type="text" class="form-control" id="adresseCourrielUsager" value="{{ old('email', $usager->email) }}" name="email" ><br/>

        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" id="prenomUsager" value="{{ old('prenom', $usager->prenom) }}"  name="prenom" ><br/>

        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nomUsager" value="{{ old('nom', $usager->nom) }}" name="nom"  ><br/>

        <div class="form-group">
                  <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="form-group">
                  <label for="password_confirmation">Mot de passe confirmation</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"><br>




    

            



            </div>
          <button type="submit" class="btn btn-primary" >Modifier les informations</button>
  
        </div>      
</form>


















@endsection