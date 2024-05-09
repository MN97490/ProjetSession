@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@section('title', "Profil")
@section('contenu')


<section class="main-container" >
<h1 class="text-center">Page modification profil de @auth {{ Auth::user()->nomUtilisateur }} @endauth</h1>
<div class="container-fluid">
<form method="POST" action="{{ route('Usagers.update', ['usager' => $usager]) }}" >
@csrf
@method('PATCH')

<div class="form-group">
  <div class="row">
    <div class="col-4" ></div>
    <div class="col-4">
        <label for="nomUtilisateurUsager">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="nomUtilisateurUsager" value="{{ old('nomUtilisateur', $usager->nomUtilisateur) }}" name="nomUtilisateur"><br/>


        <label for="adresseCourrielUsager">Adresse courriel</label>
        <input type="text" class="form-control" id="adresseCourrielUsager" value="{{ old('email', $usager->email) }}" name="email" ><br/>

        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" id="prenomUsager" value="{{ old('prenom', $usager->prenom) }}"  name="prenom" ><br/>

        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nomUsager" value="{{ old('nom', $usager->nom) }}" name="nom"  ><br/>

        <input type="text" class="form-control" id="adresseCourrielUsager" value="{{ old('domaineEtude', $usager->domaineEtude) }}" name="domaineEtude"  hidden ><br/>

        <input type="text" class="form-control" id="roleUsager" value="{{ old('role', $usager->role) }}" name="role"  hidden ><br/>

        <label for="presence">Présence :</label><br/>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="presence" id="presentiel" value="presentiel" {{ $usager->presence == 'presentiel' ? 'checked' : '' }}>
            <label class="form-check-label" for="presentiel">Présentiel</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="presence" id="distanciel" value="distanciel" {{ $usager->presence == 'distanciel' ? 'checked' : '' }}>
            <label class="form-check-label" for="distanciel">Distanciel</label>
        </div><br/><br/>

        <div class="form-group">
                  <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" value="{{$usager->password}}">
                <div class="form-group">
                  <label for="password_confirmation">Mot de passe confirmation</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"><br>




    

            



            </div>
          <button type="submit" class="btn btn-success" >confirmer les modifications</button>
  
        </div>      

      </form>
      <div class="col-4"></div>
    </div>
    </div>
</div>


















@endsection