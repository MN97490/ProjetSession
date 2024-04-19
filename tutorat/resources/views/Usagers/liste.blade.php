@extends('layouts.app')
@section('title', "Profil")
@section('contenu')

@role('admin')

  <!-- MAIN CONTAINER -->
  <div class="container-fluid">
    <div class="row">
        <div class="col-6" id="colusagers">
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
        </div>
    
    
        <div class="col-6">
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
                <input type="radio" id="html" name="fav_language" value="HTML">


                <label for="role">Type de compte:</label>
                <input type="radio" class="form-control" id="role" name="role" value="eleve">
                <label for="role" id="role" name="role">Élève:</label><br>
               
                <input type="radio" class="form-control" id="role" name="role" value="prof">
                <label for="role" id="role" name="role">Prof:</label><br>
               
                <input type="radio" class="form-control" id="role" name="role" value="admin">
                <label for="role" id="role" name="role">Admin:</label><br>
                
                <input type="submit" value="Ajouter un utilisateur" class="btn btn-success">

                
        </form> 
</div>
<div class="col-6">
        @if (count($domainesEtude))
      <h1 id="usagers">Domaine d'étude</h1>

            @foreach($domainesEtude as $domaine)
            <div class="box">
                <form>            
                    {{$domaine->nomDomaine}}
                  <button type="submit" formaction="{{ route('Domaines.modifier', ['domaine' => $domaine]) }}"  class="options-button ">...</button>
                </form>
          
              </a>
              </div>
            @endforeach
            @else
          <p>Il n'y a aucun domaine d'étude.</p>
          @endif

          

          @foreach($domainesEtude as $domaine)
    <h2>{{ $domaine->nomDomaine }}</h2>
    <ul>
        @foreach($domaine->matieres as $matiere)
            <li>
                
                <form action="{{ route('Domaines.destroyRelation', ['idDomaine' => $domaine->id, 'idMatiere' => $matiere->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    {{ $matiere->nomMatiere }}   <button type="submit" class="btn btn-danger">X</button>
                </form>
            </li>
        @endforeach
    </ul>
@endforeach
</div>
<div class="col-6">
<form action="{{ route('Domaines.ajoutRelation') }}" method="POST">
    @csrf
    <div>
    <h2>AJOUT RELATION  </h2>
        <label for="domaine">Domaine:</label>
        <select name="idDomaine" id="domaine">
            @foreach($domainesEtude as $domaine)
                <option value="{{ $domaine->id }}">{{ $domaine->nomDomaine }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="matiere">Matière:</label>
        <select name="idMatiere" id="matiere" style="margin: 10px">
            @foreach($matieres as $matiere)
                <option value="{{ $matiere->id }}">{{ $matiere->nomMatiere }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Valider la relation</button>
</form>







        <form action="{{ route('Domaines.store') }}" method="POST">
                 @csrf
                <label for="nomDomaine">Nom domaine étude:</label>
                <input type="text" name="nomDomaine"  placeholder="Nom domaine étude"><br>
              
                
                
                <input type="submit" value="Ajouter un domaine d'étude" class="btn btn-success" style="margin-top: 5px">
        </form> 

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
</div>
@endif
@else
    <script>window.location = "{{ route('Tutorat.index') }}";</script>
</div>

@endrole

@endsection
