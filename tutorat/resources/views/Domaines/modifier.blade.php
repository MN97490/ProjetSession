@extends('layouts.app')
@section('title', "Page d'acceuil")
@section('contenu')

@role('admin','prof')
<section class="main-container" >
  <h1 class="text-center">Page modification du domaine d'étude </h1>
  <form method="POST" action="{{ route('Domaines.update', ['domaine' => $domaine]) }}" >
  @csrf
  @method('PATCH')
  <div class="form-group">
        <label for="nomDomaine">Nom domaine d'étude</label>
        <input type="text" class="form-control" id="nomUtilisateurUsager" value="{{ old('nomDomaine', $domaine->nomDomaine) }}" name="nomDomaine"><br/>


       
          <button type="submit" class="btn btn-primary" >Modifier les informations du domaine d'étude</button>
  
        </div>      
  </form>
  @else
    <script>window.location = "{{ route('Tutorat.index') }}";</script>


@endrole

@endsection