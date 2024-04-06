@extends('layouts.app')
@section('title', "Profil")
@section('contenu')

<section class="main-container" >
<h1 class="text-center">Page de modification du profil</h1>
<form method="POST" action="" >
<div class="form-group">
            <label for="nomUtilisateurUsager">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="nomUtilisateurUsager" placeholder="Nom d'utilisateur" name="nomUtilisateur" value=""><br/>


            <label for="adresseCourrielUsager">Adresse courriel</label>
            <input type="text" class="form-control" id="adresseCourrielUsager" placeholder="Adresse Courriel" name="adresseCourriel" value=""><br/>

            <label for="motDePasse">Mot de passe</label>
            <input type="text" class="form-control" id="motDePasseUsager" placeholder="Mot de passe" name="motDePasse"><br/>




    

            



            </div>
          <button type="submit" class="btn btn-primary" >Enregistrer</button>
  
        </div>      
</form>
@endsection