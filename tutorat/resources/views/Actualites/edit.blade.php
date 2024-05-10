@extends('layouts.app')

@section('title', "Page modification actu")

@section('contenu')
@role('admin')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<section class="main-container">
    <div class="container mt-4">
        <h1 class="mb-4">Modifier l'actualité</h1>
        <form action="{{ route('Actualites.update', $actualite->id) }}" method="POST">
            @csrf
            @method('PATCH') 

            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $actualite->title }}" required>
               
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $actualite->description }}</textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Image actuelle</label>
                <div class=" align-items-center">
                    <img src="{{ asset($actualite->image) }}" alt="Image de couverture" class="img-thumbnail" style="width: 100px;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</section>
@else
    <script>window.location = "{{ route('Tutorat.index') }}";</script>


@endrole
@endsection
