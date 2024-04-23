@extends('layouts.app')
@section('title', "Messagerie")
@section('contenu')
<br><br><br><br><br><br><br>

<div class="container">
    @include('conversation.users',['users' => '$user'])
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">{{$users->nom }}</div>
            <div class="card-body conversation"></div>
        </div>
    </div>

</div>