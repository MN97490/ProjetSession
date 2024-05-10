@extends('layouts.app')
@section('title', "Gestion Domaine Étude ")
@section('contenu')


@role('admin','prof')
<section class="main-container" >
  <h1 class="text-center">Page modification de la matière </h1>
  <form method="POST" action="{{ route('Matieres.update', ['matiere' => $matiere]) }}" >
  @csrf
  @method('PATCH')
  <div class="form-group">
        <label for="nomDomaine">Nom matière</label>
        <input type="text" class="form-control" id="nomUtilisateurUsager" value="{{ old('nomMatiere', $matiere->nomMatiere) }}" name="nomMatiere"><br/>


       
          <button type="submit" class="btn btn-primary" >Modifier les informations du domaine d'étude</button>
  
        </div>      
  </form>








  @else
    <script>window.location = "{{ route('Tutorat.index') }}";</script>


@endrole

@endsection