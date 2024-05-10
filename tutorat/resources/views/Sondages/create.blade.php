@extends('layouts.app')

@section('title', 'Créer un Sondage')

@section('contenu')
@role('admin')
<section class="main-container">
    <h1>Créer un Nouveau Sondage</h1>
    <form action="{{ route('Sondages.store') }}" method="POST">
        @csrf
        <div>
            <label for="titre">Titre:</label><br>   
            <input type="text" name="titre" id="titre" required>
        </div>
        <div>
            <label for="description">Description:</label><br>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="type">Type de Sondage:</label><br>
            <select name="type" id="type">
                <option value="question">Question</option>
                <option value="evaluation">Évaluation</option>
            </select>
        </div>

        <button type="submit">Créer</button>
    </form>
</section>
@else
    <script>window.location = "{{ route('Tutorat.index') }}";</script>


@endrole
@endsection
