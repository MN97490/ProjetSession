<<<<<<< Updated upstream


<body>
@foreach($users as $user) 
<ul>
    <li>{{$user->nom }}</li>
</ul>
</body>
@endforeach
=======
@extends('layouts.app')
@section('title', "Messagerie")
@section('contenu')
<br><br><br><br><br><br><br>

<div class="container">
    @include('conversation.users',['user' => $users])
</div>
>>>>>>> Stashed changes
