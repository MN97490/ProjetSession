@extends('layouts.app')

@section('title', "Page d'accueil")

@section('contenu')
<section class="main-container">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-4">
    <h1 class="mb-4">Actualités</h1>
    
    <div class="row">
        @foreach($actualites as $actualite)
            <div class="col-md-4 mb-4">
                <div style="border: 1px solid #ccc; padding: 10px;">
                    <img src="{{ asset($actualite->image) }}" alt="{{ $actualite->title }}" class="img-fluid mb-2" style="width: 100%; height: auto;">
                    <h5>{{ $actualite->title }}</h5>
                    <p>{{ $actualite->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
</section>
@endsection
