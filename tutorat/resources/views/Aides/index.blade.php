@extends('layouts.app')

@section('title', "Page demande aide")

@section('contenu')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">




<section class="main-container">
    <div class="container">
        <h1>Poster une demande d'aide</h1>
        <form action="{{ route('Aides.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="texte" class="form-label">Description de l'aide</label>
                <textarea class="form-control" id="texte" name="texte" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Poster</button>
        </form>
        <div class="mt-2">
                <a href="{{ asset('downloads/guide-Prof.pdf') }}" download="GuideProf.pdf" class="btn btn-info">Télécharger le Guide Prof</a>
            </div>
            <div class="mt-2">
                <a href="{{ asset('downloads/guide-Eleve.pdf') }}" download="GuideEleve.pdf" class="btn btn-info">Télécharger le Guide de l'Eleve</a>
            </div>
    </div>

    <div class="container my-4">
        <h1>Demandes d'aide en cours :</h1>
        <div class="row">
            @foreach($aide as $a)
                @if($a->status == 'en cours')
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">{{ $a->texte }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span>Statut : {{ $a->status }}</span>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('Aides.edit', $a->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                                    <form action="{{ route('Aides.destroy', $a->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="container my-4">
        <h1>Demandes d'aide terminées :</h1>
        <div class="row">
            @foreach($aide as $a)
                @if($a->status == 'terminer')
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">{{ $a->texte }}</p>
                            </div>
                            <div class="card-footer">
                                <span>Statut : {{ $a->status }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

</section>
@endsection
