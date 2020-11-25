@extends('panel.layouts.blank')

@section('title')
Iniciar sesión
@endsection

@section('content')
<div class="row justify-content-sm-center">
    <div class="col-md-4 col-sm-10">
        <div class="login-logo">
            <a href="{{ route('login') }}">Iniciar sesión</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                @include('panel.parts.alert')
                <form action="{{route('login')}}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group">
                        <div class="input-group mt-3 @error('email') is-invalid @enderror">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="{{ __('E-Mail Address') }}" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                        <small class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group mt-3">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="{{ __('Password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                        <small class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Start') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1">
                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
<!-- /.login-box -->
@endsection('content')
