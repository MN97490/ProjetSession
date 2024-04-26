

@extends('layouts.app')
@section('title', "Messagerie")
@section('contenu')
<br><br><br><br><br><br><br>


@section('content')
<div class="container">
    @include('conversation.users',['user' => $users])
</div>
@endsection