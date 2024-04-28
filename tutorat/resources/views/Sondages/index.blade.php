<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sondage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
@if(auth()->user() && auth()->user()->role == 'admin')
    <script>window.location = "{{ route('Tutorat.index') }}";</script>
@else
  
 


   



<div class="container mt-5">
    <h1 class="mb-4">Répondre aux Sondages</h1>

    @if($sondagesEnCours->isEmpty())
        <div class="alert alert-info">Il n'y a aucun sondage en cours.</div>
    @else
        @foreach($sondagesEnCours as $sondage)
            <div class="card mb-3">
                <div class="card-header">
                    <strong>{{ $sondage->titre }}</strong>
                </div>
                <div class="card-body">
                    <p>{{ $sondage->description }}</p>
                    @if($sondage->type === 'evaluation')
                        <form action="{{ route('commentaires.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="sondage_id" value="{{ $sondage->id }}">
                            <div class="mb-3">
                                <label for="note" class="form-label">Votre Note :</label>
                                <input type="number" class="form-control" id="note" name="note" min="1" max="5" required>
                            </div>
                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Votre Commentaire :</label>
                                <textarea class="form-control" id="commentaire" name="contenu" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    @else
                        <form action="{{ route('commentaires.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="sondage_id" value="{{ $sondage->id }}">
                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Votre Commentaire :</label>
                                <textarea class="form-control" id="commentaire" name="contenu" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>

</body>
</html>

@endif

