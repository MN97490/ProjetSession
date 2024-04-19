@extends('layouts.app')
@section('title', "Gestion Domaine Étude ")
@section('contenu')
<br><br><br><br><br><br><br>
<section class="main-container" >
    <form action="{{ route('Matieres.storeProf') }}" method="POST">
        @csrf
        <label for="nomMatiere">Nom matière:</label>
        <input type="text" name="nomMatiere" placeholder="Nom matière"><br>


        <!-- Assurez-vous que ce champ contient la valeur de l'ID du domaine d'étude -->
        
                
        <input type="submit" value="Ajouter une matière">
    </form>
</section>

<form action="{{ route('Domaines.ajoutRelation') }}" method="POST">
    @csrf
    <div>
        <h2>AJOUT RELATION</h2>
      
        <input type="hidden" name="idDomaine" value="{{ $domaine->id }}">
    </div>
    <div>
        <label for="matiere">Matière:</label>
        <select name="idMatiere" id="matiere">
            @foreach($matieress as $matiere)
                <option value="{{ $matiere->id }}">{{ $matiere->nomMatiere }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Valider la relation</button>
</form>




<h2>{{ $domaine->nomDomaine }}</h2>
<ul>
    @foreach($domaine->matieres as $matiere)
        <li>
            <form action="{{ route('Domaines.destroyRelation', ['idDomaine' => $domaine->id, 'idMatiere' => $matiere->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                {{ $matiere->nomMatiere }}   <button type="submit">X</button>
            </form>
        </li>
    @endforeach
</ul>

