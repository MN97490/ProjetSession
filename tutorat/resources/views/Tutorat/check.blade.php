@extends('layouts.app')

@section('title', 'Ma Rémunération')

@section('contenu')
    <h1>Ma Rémunération des Deux Dernières Semaines</h1>
    <form method="POST" action="{{ route('remuneration.verify') }}">
        @csrf
        <label for="password">Entrez votre mot de passe pour voir les informations:</label>
        <input type="password" name="password" required>
        <button type="submit">Vérifier</button>
    </form>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
