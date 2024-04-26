@extends('layouts.app')
@section('title', "Messagerie")
@section('contenu')
<br><br><br><br>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<section class="main-container">
<div class="col-md-3">
    <div class="list-group">
        
        @foreach($users as $user) 
      <a class="list-group-item list-group-item-action" href="{{route('conversation.users',$user)}}">{{$user->prenom }} {{$user->nom }}</a>
        @endforeach
        
    </div>
</div>
</section>
@endsection