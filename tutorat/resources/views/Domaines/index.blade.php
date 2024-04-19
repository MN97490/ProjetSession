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

@endsection
