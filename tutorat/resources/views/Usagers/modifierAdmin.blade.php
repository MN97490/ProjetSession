@extends('layouts.app')
@section('title', "Page modification Administrateur")
@section('contenu')

<section class="main-container">
  <h1 class="text-center">Page modification profil de   </h1>
  <form method="POST" action="{{ route('Usagers.updateAdmin', ['usager' => $usager]) }}" >
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

      <label for="domaineetude">Domaine d'étude:</label>
      <select name="domaineEtude" id="domaineetude">
          @foreach($domainesEtude as $domaine)
              <option value="{{ $domaine->id }}" {{ $domaine->id == $usager->domaineEtude ? 'selected' : '' }}>{{ $domaine->nomDomaine }}</option>
          @endforeach
      </select><br><br>

      <label for="role">Rôle:</label>
      <select name="role" id="role">
          <option value="admin" {{ $usager->role == 'admin' ? 'selected' : '' }}>Admin</option>
          <option value="prof" {{ $usager->role == 'prof' ? 'selected' : '' }}>Prof</option>
          <option value="eleve" {{ $usager->role == 'eleve' ? 'selected' : '' }}>Élève</option>
      </select><br><br>
 
      <div class="form-group">
    <label for="is_tuteur">Tuteur:</label><br>
    <input type="radio" name="is_tuteur" id="is_tuteur_oui" value="1" {{ $usager->is_tuteur ? 'checked' : '' }}>
    <label for="is_tuteur_oui">Oui</label>
    <input type="radio" name="is_tuteur" id="is_tuteur_non" value="0" {{ !$usager->is_tuteur ? 'checked' : '' }}>
    <label for="is_tuteur_non">Non</label>
</div>




      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" value="{{ old('password', $usager->password) }}">
      </div>
      
      <div class="form-group">
        <label for="password_confirmation">Confirmer le mot de passe</label>
        <input type="password" class="form-control" id="password_confirmation" value="{{ old('password', $usager->password) }}" name="password_confirmation">
      </div>

      <button type="submit" class="btn btn-primary" >Modifier les informations</button>
    </div>      
  </form>
</section>

@endsection
