@extends('layouts.app')
@section('title', "Profil")
@section('contenu')

@role('admin')

  <!-- MAIN CONTAINER -->
  <section class="main-container" >
      <div class="location" id="personne">
      @if (count($usagers))
      <h1 id="usagers">Usagers</h1>

            @foreach($usagers as $usager)
            <div class="box">
                <form>            
                    {{$usager->nomUtilisateur}}
                  <button type="submit" formaction="{{ route('Usagers.modifierAdmin', ['usager' => $usager]) }}"  class="options-button ">...</button>
                </form>
                <form method="POST" action="{{route('Usagers.destroy', [$usager->id]) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">X</button>
                </form>
              </a>
              </div>
            @endforeach
            @else
          <p>Il n'y a aucun usager.</p>
          @endif
          
        </div>

        <form action="{{ route('usagers.storeAdmin') }}" method="POST">
                 @csrf
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" name="nomUtilisateur"  placeholder="Utilisateur"><br>
              
                <label for="email">Adresse courriel:</label>
                <input type="text" name="email" placeholder="Adresse courriel"><br>

                <label for="email">Nom:</label>
                <input type="text" name="nom"  placeholder="Nom"><br>

                <label for="email">Prénom:</label>
                <input type="text" name="prenom" placeholder="Prénom"><br>

                                <label for="domaineetude">Domaine d'étude:</label>
                <select name="domaineEtude" id="domaineetude">
                    @foreach($domainesEtude as $domaine)
                        <option value="{{ $domaine->id }}">{{ $domaine->nomDomaine }}</option>
                    @endforeach
                </select><br><br>

                
                <label for="password">Mot de Passe:</label>
                <input type="password" name="password"  placeholder="Mot de Passe"><br>
        
                <label for="password">Confirmer le mot de Passe:</label>
                <input type="password" name="password_confirmation"  placeholder="Confirmer le mot de Passe"><br>

                <label for="role">Type de compte</label>
                <input type="radio" class="form-control" id="role" name="role" value="eleve">
                <label for="role" id="role" name="role">Élève:</label><br>
               
                <input type="radio" class="form-control" id="role" name="role" value="prof">
                <label for="role" id="role" name="role">Prof:</label><br>
               
                <input type="radio" class="form-control" id="role" name="role" value="admin">
                <label for="role" id="role" name="role">Admin:</label><br>
                
                <input type="submit" value="Ajouter un utilisateur">
        </form> 

 

@else
    <script>window.location = "{{ route('Tutorat.index') }}";</script>
@endrole

@endsection
