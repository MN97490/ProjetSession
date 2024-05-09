@extends('layouts.app')

@section('title', "Modifier la demande d'aide")

@section('contenu')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="container">
    <h1>Modifier la demande d'aide</h1>
    <form action="{{ route('Aides.update', $aide->id) }}" method="POST">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="texte" class="form-label">Description de l'aide</label>
            <textarea class="form-control" id="texte" name="texte" rows="3">{{ $aide->texte }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
