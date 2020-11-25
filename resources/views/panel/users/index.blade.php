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
        <table class="table table-responsive-md auto-count">
            <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <a href="{{route('panel.users.index',['filter'=>'name','order'=>$order,'page'=>$page])}}"
                            class="text-reset text-decoration-none font-weight-bold">
                            Nombre <span class="fa fa-sort"></span>
                        </a>
                    </th>
                    <th>
                        <a href="{{route('panel.users.index',['filter'=>'email','order'=>$order,'page'=>$page])}}"
                            class="text-reset text-decoration-none font-weight-bold">
                            Email <span class="fa fa-sort"></span>
                        </a>
                    </th>
                    <th>Roles</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <td></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-xs bg-navy" href="{{route('panel.users.edit',$user)}}">
                            <i class="fa fa-edit  fa-fw"></i>
                        </a>
                        <a class="btn btn-xs bg-danger" href="#" onclick="event.preventDefault();
                        document.getElementById('destroy-form-user-{{$user->id}}').submit();">
                            <i class="fa fa-trash fa-fw"></i>
                        </a>
                        <form id="destroy-form-user-{{$user->id}}" action="{{route('panel.users.destroy',$user)}}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </div>
    {{-- <div class="card-footer"></div> --}}
</div>
@endsection
