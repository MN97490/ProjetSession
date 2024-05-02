@extends('layouts.app')

@section('title', 'Gestion des Aides')

@section('contenu')
<section class="main-container">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h1 class="mb-4 text-center">Mise à jour du Guide de l'Usager</h1>

    
    <div class="mb-4">
        <form action="{{ route('Aides.uploadGuide') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="guideFile" class="form-label">Charger un nouveau guide Prof</label>
                <input type="file" class="form-control" id="guideFile" name="guideFile" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour le guide</button>
        </form>
    </div>

    <div class="mb-4">
        <form action="{{ route('Aides.uploadGuideEleve') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="guideFile" class="form-label">Charger un nouveau guide Eleve</label>
                <input type="file" class="form-control" id="guideFile" name="guideFile" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour le guide</button>
        </form>
    </div>
<div class="container mt-4">
    <h1 class="mb-4 text-center">Gestion des Demandes d'Aide</h1>

    <div class="row">
       
        <div class="col-md-6">
            <h2>Demandes en Cours</h2>
            <div class="list-group">
                @foreach($aides as $aide)
                    @if($aide->status == 'en cours')
                        <div class="list-group-item">
                            <h5 class="mb-1">{{ $aide->getUserName() }} - {{ $aide->created_at->format('d/m/Y') }}</h5>
                            <p class="mb-1">{{ $aide->texte }}</p>
                            <small>Statut: {{ $aide->status }}</small>
                            <form action="{{ route('Aides.updateStatus', $aide->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="terminer">
                                <button type="submit" class="btn btn-success btn-sm">Terminer</button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        
        <div class="col-md-6">
            <h2>Demandes Terminées</h2>
            <div class="list-group">
                @foreach($aides as $aide)
                    @if($aide->status == 'terminer')
                        <div class="list-group-item">
                            <h5 class="mb-1">{{ $aide->getUserName() }} - {{ $aide->created_at->format('d/m/Y') }}</h5>
                            <p class="mb-1">{{ $aide->texte }}</p>
                            <small>Statut: {{ $aide->status }}</small>
                            <form action="{{ route('Aides.destroy', $aide->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
</section>
@endsection
