@extends('layouts.app')
@section('entete')
@stop
@section('titre')
Club des Usagers de l'Espace galactique
@stop
@section('titre_contenu')
Liste des membres
@stop
@section('content')
@foreach ($les_membres as $membre)
@guest
    <h3>
      - {{ $membre->prenom }} {{ $membre->nom }}
    </h3>
    <br><br>
@else
  @if ($membre->nom.' '.$membre->prenom === Auth::user()->name)
    <h3>
      - <a href="/modifier/{{ $membre->id }}"> {{ $membre->prenom }} {{ $membre->nom }}</a>
    </h3>
  @else
    <h3>
      - {{ $membre->prenom }} {{ $membre->nom }}
    </h3>
  @endif
    <div class='h2'>
      {{ $membre->adresse }}
    </div>
    <br><br>
@endguest
@endforeach
@guest
@else
<a href="{{ url('/creer') }}"> Créer nouveau membre </a>
@endguest
@stop
@section('pied_page')
LicenceProServiceTic 2022
@stop