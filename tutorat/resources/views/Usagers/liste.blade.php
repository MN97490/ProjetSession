@extends('layouts.app')
@section('title', "Profil")
@section('contenu')


 <!-- MAIN CONTAINER -->
 <section class="main-container" >
      <div class="location" id="personne">
      @if (count($usagers))
      <h1 id="usagers">Usagers</h1>

            @foreach($usagers as $usager)
            <div class="box">
                <form>            
                    {{$usager->nomUsager}}
                  <button type="submit" formaction="{{ route('usagers.edit', [$usager]) }}"  class="options-button ">...</button>
                </form>
                <form method="POST" action="{{route('usagers.destroy', [$usager->id]) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">X</button>
                </form>
              </a>
              </div>
            @endforeach
            @else
          <p>Il n'y a aucun usager.</p>
          @endif
          
        </div>
    <!-- END OF MAIN CONTAINER -->










@endsection