@extends('layouts.app')

@section('title', 'Gestion Actualités')

@section('contenu')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<section class="main-container">
    <div class="container">
    <h1>Actualités</h1>
    @foreach ($actualites as $actualite)
        <div class=box>
            <img src="{{ asset($actualite->image) }}" alt="Image de couverture" style="max-width:100px; height:auto;">
            <h2>{{ $actualite->title }}</h2>
            <p>{{ $actualite->description }}</p>
           
            <form action="{{ route('Actualites.destroy', $actualite->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>
            <form action="{{ route('Actualites.edit', $actualite->id) }}" method="GET">
            @csrf
            <button type="submit">Modifier</button>
            
            </form>
        </div>
    @endforeach
    </div> 

    <div class="container">
        <h1>Ajouter une actualité</h1>
        <form action="{{ route('Actualites.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image de couverture</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
   
</section>
@endsection
