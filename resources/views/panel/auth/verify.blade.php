@extends('panel.layouts.blank')
@section('title')
Registro de usuario
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-sm-10">
        <div class="register-logo">
            <a href="{{route('verification.notice')}}">{{ __('Verify Your Email Address') }}</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                @if (session('resent'))
                <div class="text-center alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }}.
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit"
                        class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
