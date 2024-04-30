
@extends('layouts.app')

@section('title', "Page modification Administrateur")

@section('contenu')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<section class="main-container">
  <h1 class="text-center">Page modification profil de </h1>
  
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ route('Usagers.updateAdmin', ['usager' => $usager]) }}">
          @csrf
          @method('PATCH')
          
          <!-- Nom d'utilisateur -->
          <div class="mb-3">
            <label for="nomUtilisateurUsager" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="nomUtilisateurUsager" value="{{ old('nomUtilisateur', $usager->nomUtilisateur) }}" name="nomUtilisateur">
          </div>

          <!-- Adresse courriel -->
          <div class="mb-3">
            <label for="adresseCourrielUsager" class="form-label">Adresse courriel</label>
            <input type="text" class="form-control" id="adresseCourrielUsager" value="{{ old('email', $usager->email) }}" name="email">
          </div>

          <!-- Prénom -->
          <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenomUsager" value="{{ old('prenom', $usager->prenom) }}" name="prenom">
          </div>

          <!-- Nom -->
          <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nomUsager" value="{{ old('nom', $usager->nom) }}" name="nom">
          </div>

          <!-- Domaine d'étude -->
          <div class="mb-3">
            <label for="domaineetude" class="form-label">Domaine d'étude:</label>
            <select class="form-control" name="domaineEtude" id="domaineetude">
                @foreach($domainesEtude as $domaine)
                    <option value="{{ $domaine->id }}" {{ $domaine->id == $usager->domaineEtude ? 'selected' : '' }}>{{ $domaine->nomDomaine }}</option>
                @endforeach
            </select>
          </div>

          <!-- Rôle -->
          <div class="mb-3">
            <label for="role" class="form-label">Rôle:</label>
            <select class="form-control" name="role" id="role">
                <option value="admin" {{ $usager->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="prof" {{ $usager->role == 'prof' ? 'selected' : '' }}>Prof</option>
                <option value="eleve" {{ $usager->role == 'eleve' ? 'selected' : '' }}>Élève</option>
            </select>
          </div>

          <!-- Tuteur -->
          <div class="mb-3">
            <label for="is_tuteur" class="form-label">Tuteur:</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="is_tuteur" id="is_tuteur_oui" value="1" {{ $usager->is_tuteur ? 'checked' : '' }}>
              <label class="form-check-label" for="is_tuteur_oui">Oui</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="is_tuteur" id="is_tuteur_non" value="0" {{ !$usager->is_tuteur ? 'checked' : '' }}>
              <label class="form-check-label" for="is_tuteur_non">Non</label>
            </div>
          </div>

          <!-- Mot de passe -->
          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password"  value="{{ old('password', $usager->password) }}">
          </div>

          <!-- Confirmer le mot de passe -->
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password', $usager->password) }}">
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Modifier les informations</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>

@endsection
