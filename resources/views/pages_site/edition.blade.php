@extends('layouts.app')
@section('entete')
@stop
@section('titre')
Club des Usagers de l'Espace galactique
@stop
@section('titre_contenu')
Modification des infos du membre
@stop
@guest
<p>Vous devez être connecté pour accéder à cette fonctionnalité.</p>
@else
  @section('content')
    @if ($un_membre->nom.' '.$un_membre->prenom === Auth::user()->name)
      <div class="formgroup">
        {!! Form::model($un_membre,['url' => url('miseAJour',$un_membre->id),'method' => 'PATCH']) !!}
        <div class="formgroup">
          {{ Form::label('nom', 'Nom') }}
          {{ Form::text('nom') }}
        </div>
        <div class="formgroup">
          {{ Form::label('prenom', 'Prenom :') }}
          {{ Form::text('prenom') }}
        </div>
        <div class="formgroup">
          {{ Form::label('adresse', 'Adresse électronique') }}
          {{ Form::text('adresse') }}
        </div>
        <p>
        </p>
        {!! Form::submit("Modifier membre", array('class' => 'btn btn-info')) !!}
        {!! Form::close() !!}
      </div>
    @else
      <p>Vous ne pouvez pas éditer un membre qui ne correspond pas à votre compte.</p>
    @endif
@endguest
@stop
@section('pied_page')
LicenceProServiceTic 2022
@stop