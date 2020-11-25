@extends('panel.layouts.panel')
@section('title')
{{ __('Pagina de inicio') }}
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Datos de Usuario</h5>
        <div class="card-tools">
        </div>
    </div>
    <div class="card-body">
        <form class="form" action="{{route('panel.profile.index')}}" method="post" id="registrationForm"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h3>{{Auth::user()->name}}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="text-center">
                        <img src="{{asset('images/avatars/'.Auth::user()->avatar)}}"
                            class="avatar img-circle img-thumbnail" alt="{{Auth::user()->name}}" id="preview-avatar">
                        <h6>Cambiar avatar</h6>
                    </div>
                    <div class="form-group">
                        <div class="custom-file @error('avatar') is-invalid @enderror">
                            <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror"
                                id="avatar" name="avatar" data-target="preview-avatar" accept="image/png, image/jpeg">
                            <label class="custom-file-label" for="avatar" data-browse="Examinar">avatar.jpg</label>
                        </div>
                        @error('avatar')
                        <small class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-9">
                    @csrf
                    <div class="form-group">
                        <label for="name">
                            {{__("Name")}}
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="{{__('Name')}}" title="{{__('Name')}}"
                            value="{{old("name",Auth::user()->name)}}">
                        @error('name')
                        <small class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">
                            {{ __('E-Mail Address') }}
                        </label>
                        <input type="text" class="form-control" name="email" id="email"
                            placeholder="{{ __('E-Mail Address') }}" title="{{ __('E-Mail Address') }}"
                            value="{{old("email",Auth::user()->email)}}" disabled>
                        @error('email')
                        <small class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">
                            {{__("Password")}}
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password" placeholder="{{__('Password')}}" title="{{__('Password')}}"
                            value="">
                        @error('password')
                        <small class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">
                            {{__('Confirm Password')}}
                        </label>
                        <input type="password" class="form-control" name="password_confirmation"
                            id="password_confirmation" placeholder="{{__('Confirm Password')}}"
                            title="{{__('Confirm Password')}}" value="">
                        @error('password_confirmation')
                        <small class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-success btn-block" type="submit"><i
                                class="glyphicon glyphicon-ok-sign"></i>
                            Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- <div class="card-footer"></div> --}}
</div>
@endsection
