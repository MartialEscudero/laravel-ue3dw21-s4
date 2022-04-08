@extends('layouts.app')
@section('entete')
@stop
@section('titre')
Club des Usagers de l'Espace galactique
@stop
@section('titre_contenu')
Infos Membre
@stop
@section('content')
@guest
  <h3>
    {{ $un_membre->prenom }} {{ $un_membre->nom }}
  </h3>
  <p>
    {{ $membre_description->description }}
  </p>
@else
  @if ($un_membre->nom.' '.$un_membre->prenom === Auth::user()->name)
    <h3>
      <a href="/modifier/{{ $un_membre->id }}"> {{ $un_membre->prenom }} {{ $un_membre->nom }}</a>
    </h3>
  @else
    <h3>
      {{ $un_membre->prenom }} {{ $un_membre->nom }}
    </h3>
  @endif
    <div class='h2'>
      {{ $un_membre->adresse }}
    </div>
    <p>
      {{ $membre_description->description }}
    </p>
@endguest
@stop
@section('pied_page')
LicenceProServiceTic 2022
@stop