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

<h2>Demandes pour être tuteur</h2>
<ul>
    @foreach($demandess as $demande)
        @if($demande->usager->domaineEtude === Auth::user()->domaineEtude)
            <li>
                <h3>Demande #{{ $demande->id }}</h3>
                <p>Motivation : {{ $demande->motivation }}</p>
                <p>Matières :</p>
                <ul>
                    @foreach($demande->matieres as $matiere)
                        <li>{{ $matiere->nomMatiere }}</li>
                    @endforeach
                </ul>
                <p>Usager : {{ $demande->usager->nom }} {{ $demande->usager->prenom }}</p>
                <form method="POST" action="{{ route('Tutorat.accepterDemande', $demande->id) }}">
                    @csrf
                    <button type="submit">Accepter</button>
                </form>
                <button type="button" onclick="toggleRefuseMotif({{ $demande->id }})">Refuser</button>
                <form method="POST" action="{{ route('Tutorat.refuserDemande', $demande->id) }}" id="refuseForm-{{ $demande->id }}" style="display: none;">
                    @csrf
                    <input type="text" name="motif" placeholder="Motif du refus" required>
                    <button type="submit">Confirmer le refus</button>
                </form>
            </li>
        @endif
    @endforeach
</ul>

<script>
    function toggleRefuseMotif(demandeId) {
        var form = document.getElementById('refuseForm-' + demandeId);
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
<h2>Tuteurs du programme {{ $domaine->nomDomaine }}:</h2>
<h2>Ajouter des autorisations</h2>
        <form action="{{ route('autorisation.add') }}" method="POST">
            @csrf
            <label for="usagerSelect">Choisir un usager :</label>
            <select name="usager_id" id="usagerSelect">
                @foreach($usagersDomaine as $usager)
                    <option value="{{ $usager->id }}">{{ $usager->nom }} {{ $usager->prenom }}</option>
                @endforeach
            </select>

            <h3>Choisir les matières :</h3>
            @foreach($matieres as $matiere)
                <div>
                    <input type="checkbox" name="matieres[]" value="{{ $matiere->id }}" id="matiere{{ $matiere->id }}">
                    <label for="matiere{{ $matiere->id }}">{{ $matiere->nomMatiere }}</label>
                </div>
            @endforeach

            <button type="submit">Ajouter les autorisations</button>
        </form>

        <ul>
    @foreach($tuteurs as $tuteur)
        <li>
            <strong>{{ $tuteur->nom }} {{ $tuteur->prenom }}</strong>
       
            <form method="POST" action="{{ route('tuteur.remove', ['usager_id' => $tuteur->id]) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir retirer ce statut de tuteur ?')">Retirer Status Tuteur</button>
            </form>

            <ul>
                <li><strong>Matières autorisées :</strong>
                    <ul>
                        @foreach($tuteur->matieresAutorisees as $matiere)
                            <li>
                                {{ $matiere->nomMatiere }}
                                <form method="POST" action="{{ route('matieres_tuteur.destroy', ['usager_id' => $tuteur->id, 'matiere_id' => $matiere->id]) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette autorisation ?')">Supprimer</button>
                                </form>
                            </li>
                            <br>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </li>
    @endforeach
</ul>


<h2>Notes des matières</h2>

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
                        <input type="number" name="newNote" min="0" max="100" value="{{ $note->Note }}" required>
                        <button type="submit">Modifier</button>
                    </form>
                </li>
            @endif
        @endforeach
    </ul>
@endforeach




</section>

@endsection

