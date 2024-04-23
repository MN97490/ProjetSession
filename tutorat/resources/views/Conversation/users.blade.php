@extends('layouts.app')
@section('title', "Messagerie")
@section('contenu')
<br><br><br><br><br><br><br>
<div class="col-md-3">
    <div class="list-group">
        
        @foreach($users as $user) 
        <li><a class="list-group-item" href="{{route('conversation.users',$user)}}">{{$user->nom }}</a></li>
        @endforeach
        
    </div>
</div>
