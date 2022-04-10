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
      @if($user->name == Auth::user()->name)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->role }}</td>
          @if($user->user_verified == 0)
          <td>Non Vérifié</td>
          @else
          <td>Vérifié</td>
          @endif
          <td>
          </td>
        </tr>
        @else
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
            <a type="button" class="btn btn-warning" onclick="window.location='{{ url('adminaccount',$user->id) }}'">Passer utilisateur admin</a>
            @else
              @if($user->name !== 'Admin')
              <a type="button" class="btn btn-info" onclick="window.location='{{ url('useraccount',$user->id) }}'">Enlever le role admin</a>
              @endif
            @endif
            @if($user->user_verified == 0)
            <a type="button" class="btn btn-success" onclick="window.location='{{ url('valideaccount',$user->id) }}'">Vérifier le compte</a>
            @else
              @if($user->name !== 'Admin')
              <a type="button" class="btn btn-danger" onclick="window.location='{{ url('invalideaccount',$user->id) }}'">Supprimer la vérification</a>
              @endif
            @endif
          </td>
        </tr>
      @endif
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