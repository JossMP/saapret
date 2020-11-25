@extends('panel.layouts.blank')
@section('title')
{{ __('Reset Password') }}
@endsection
@section('content')
<div class="row justify-content-sm-center">
    <div class="col-md-8">
        <div class="register-logo">
            <a href="{{route('password.request')}}">{{ __('Reset Password') }}</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                @if (session('status'))
                <div class="text-center alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
                    @csrf

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
