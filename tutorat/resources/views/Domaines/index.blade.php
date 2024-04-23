@extends('layouts.app')
@section('title', "Gestion Domaine Étude ")
@section('contenu')
<br>
<section class="main-container" >
    <form action="{{ route('Matieres.storeProf') }}" method="POST">
        @csrf
        <h2>AJOUT Matière</h2>
        <label for="nomMatiere">Nom matière:</label>
        <input type="text" name="nomMatiere" placeholder="Nom matière"><br>


 
        
                
        <input type="submit" value="Ajouter une matière">
    </form>


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

            <form>            
                   
                  <button type="submit" formaction="{{ route('Matieres.modifierMatiere', ['matiere' => $matiere]) }}"  class="options-button ">...</button>
                </form>
        </li>
    @endforeach
</ul>
@foreach($matieres as $matiere)
    <h3>{{ $matiere->nomMatiere }}</h3>
    <ul>
        @foreach($notesParMatiere[$matiere->id] as $note)
            @if($note->usager->domaineEtude == Auth::user()->domaineEtude)
                <li>
                    <div>
                        <strong>Utilisateur :</strong> {{ $note->usager->nomUtilisateur }} <br>
                        <strong>Nom :</strong> {{ $note->usager->nom }} <br>
                        <strong>Prénom :</strong> {{ $note->usager->prenom }} <br>
                    </div>
                    <form method="POST" action="{{ route('notes.update', ['noteId' => $note->id]) }}">
                        @csrf
                        @method('PUT')
                        <input type="number" name="newNote" min="0" max="20" value="{{ $note->Note }}" required>
                        <button type="submit">Modifier</button>
                    </form>
                </li>
            @endif
        @endforeach
    </ul>
@endforeach
</section>



