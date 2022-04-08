@extends('layouts.app')
@section('entete')
@stop
@section('titre')
Administration
@stop
@section('titre_contenu')
Infos Membre
@stop
@section('content')
@if(Auth::user() && (Auth::user()->role == 'admin'))
<h1>Administration</h1>
<table class="table table-striped table-bordered">
  <thead>
      <tr>
          <th>Nom</th>
          <th>Role</th>
          <th>Compte Verifié</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
      <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->role }}</td>
          @if($user->user_verified == 0)
          <td>Non Vérifié</td>
          @else
          <td>Vérifié</td>
          @endif
          <td>
            @if($user->role == 'user')
            <a type="button" class="btn btn-success">Passer role admin</a>
            @endif
            @if($user->user_verified == 0)
            <a type="button" class="btn btn-warning" onclick="window.location='{{ url('truecompte') }}'">Vérifier le compte</a>
            @endif
          </td>
      </tr>
    @endforeach
  </tbody>
</table>
@else
<p>Vous n'êtes pas administrateur.</p>
@endif
@stop
@section('pied_page')
LicenceProServiceTic 2022
@stop