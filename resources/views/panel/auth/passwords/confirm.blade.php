@extends('panel.layouts.blank')

@section('title')
Confirmacion de contraseña
@endsection
@section('content')
<div class="row justify-content-sm-center">
    <div class="col-md-8">
        <div class="lockscreen-wrapper">
            <div class="lockscreen-logo">
                <a href="">Confirma tu clave</a>
            </div>
            <!-- User name -->
            <div class="lockscreen-name text-center text-bold">{{Auth::user()->name}}</div>

            <!-- START LOCK SCREEN ITEM -->
            <div class="lockscreen-item">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                    <img src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="{{Auth::user()->name}}">
                </div>
                <!-- /.lockscreen-image -->

                <!-- lockscreen credentials (contains the form) -->
                <form method="POST" action="{{ route('password.confirm') }}" class="lockscreen-credentials">
                    @csrf
                    <div class="input-group @error('password') is-invalid @enderror">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            placeholder="{{ __('Password') }}" autocomplete="current-password" autofocus>
                        <div class="input-group-append">
                            <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
                        </div>
                    </div>
                </form>
                <!-- /.lockscreen credentials -->

            </div>
            @error('password')
            <div class="text-center text-danger text-form" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            <!-- /.lockscreen-item -->
            <div class="help-block text-center">
                {{ __('Please confirm your password before continuing.') }}
            </div>
            <div class="text-center">
                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
