@extends('panel.layouts.panel')
@section('title')
Editar Usuario
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Editar datos de usuario</h5>
        <div class="card-tools">
        </div>
    </div>

    <div class="card-body">
        <form class="form" action="{{route('panel.users.update',$user)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h3 class="m-0">{{$user->name}} {{$user->last_name}}</h3>
                    <span class="text-muted">({{$user->username}})</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="{{asset('images/avatars/'.$user->avatar)}}" class="avatar img-circle img-thumbnail"
                            alt="Avatar" id="preview-avatar">
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
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">
                                    {{__("Name")}}
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" placeholder="{{__('Name')}}" title="{{__('Name')}}"
                                    value="{{old("name",$user->name)}}" required>
                                @error('name')
                                <small class="text-bold invalid-feedback m-0">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="last_name">
                                    Apellidos
                                </label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" id="last_name" placeholder="Apellidos" title="Apellidos"
                                    value="{{old("last_name",$user->last_name)}}">
                                @error('last_name')
                                <small class="text-bold invalid-feedback m-0">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            {{ __('E-Mail Address') }}
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" placeholder="{{ __('E-Mail Address') }}" title="{{ __('E-Mail Address') }}"
                            value="{{old("email",$user->email)}}" required>
                        @error('email')
                        <small class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">
                            Usuario
                        </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                            id="username" placeholder="Usuario" title="Usuario"
                            value="{{old("username",$user->username)}}" disabled>
                        @error('username')
                        <small class="text-bold invalid-feedback m-0">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">
                                    {{__("Password")}}
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="{{__('Password')}}"
                                    title="{{__('Password')}}" value="">
                                @error('password')
                                <small class="text-bold invalid-feedback m-0">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
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
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="roles">Roles</label>
                        @role('super-admin')
                        <div class="float-right">
                            Super admin
                            <label class="float-right switch switch-sm switch-pill switch-label switch-success">
                                <input type="checkbox" class="switch-input" id="is_super" name="is_super"
                                    @if(old('is_super',$user->hasRole('super-admin'))) checked @endif>
                                <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                            </label>
                        </div>
                        @endrole
                        <select name="roles[]" id="roles" class="form-control" multiple>
                            @foreach ($roles as $role)
                            <option value="{{$role->name}}" @if ($user->hasRole($role->name)) selected
                                @endif>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-success btn-block" type="submit">
                            <i class="fa fa-fw fa-check"></i>
                            Registrar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- <div class="card-footer"></div> --}}
</div>
@endsection
