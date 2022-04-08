@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::user() && (Auth::user()->user_verified == 1))
                    {{ __('Vous êtes bien connecté !') }}
                    @else
                    {{ __('Votre compte doit être validé par un administrateur pour accéder au site !') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
