@extends('panel.layouts.blank')

@section('title')
Registro de usuario
@endsection

@section('content')
<div class="row justify-content-sm-center">
    <div class="col-lg-4 col-md-5 col-sm-10">
        <div class="register-logo">
            <a href="{{route('home')}}">Registro de usuario</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                @include('panel.parts.alert')
                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group">
                        <div class="input-group mt-3 @error('name') is-invalid @enderror">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ __('Name') }}" value="{{ old('name') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        @error('name')
                        <div class="text-bold text-bold invalid-feedback m-0">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group mt-3 @error('email') is-invalid @enderror">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                        <div class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group mt-3  @error('password') is-invalid @enderror">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{__('Password')}}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                        <div class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group mt-3 @error('password_confirmation') is-invalid @enderror">
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="{{__('Confirm Password')}}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password_confirmation')
                        <div class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mt-4">
                        <div class="col-8">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input @error('terms') is-invalid @enderror"
                                    name="terms" id="terms" {{ old('terms') ? 'checked' : '' }} required>
                                <label class="custom-control-label" for="terms">
                                    {{__('I agree to the')}} <a href="#">{{__('terms')}}</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{__('Register')}}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
</div>
@endsection
