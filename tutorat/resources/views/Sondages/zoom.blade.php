@extends('layouts.app')

@section('title', "Détails du Sondage")

@section('contenu')
@role('admin')
<section class="main-container">
    <h1>Détails du Sondage: {{ $sondage->titre }}</h1>
    <p>Description: {{ $sondage->description }}</p>
    
    @if($sondage->type === 'evaluation')
        <p>Rating Moyen des Evaluations: {{ $sondage->ratingSondage }}/5</p>
    @endif

    <h2>Commentaires</h2>
    @if($sondage->commentaires->isEmpty())
        <p>Aucun commentaire pour ce sondage.</p>
    @else
        <ul>
            @foreach($sondage->commentaires as $commentaire)
                <li>
                    <strong>Commentaire:</strong> {{ $commentaire->contenu }}
                    @if(isset($commentaire->note))
                        <br><strong>Note:</strong> {{ $commentaire->note }}/5
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
    
</div>




</section>
@else
    <script>window.location = "{{ route('Tutorat.index') }}";</script>


@endrole



@endsection
