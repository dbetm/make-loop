@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissable">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left panelUp"><b>Usuarios</b></h4>
                    <div class="row">
                        <div class="col-lg-4 pull-right">
                            <form action="{{ url('admin/users') }}" method="GET" role="search">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="arg" placeholder="Escribe el ID o correo">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search "></span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if($user->is_active == 1)
                                        <td>Activo</td>
                                    @else
                                        <td>No activo</td>
                                    @endif
                                    <td>{{ $user->role }}</td>
                                    @if($user->is_active == 1)
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3 col-offset-3">
                                                    <form action="{{ url('admin/users', $user->id) }}" method="POST" class="form-inline" onsubmit="return confirmAction();">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PATCH') }}
                                                        <button type="submit" class="btn btn-success btn-xs" title="Volver admin" @if($user->role == 'admin') disabled @endif>
                                                            <i class="fa fa-magic"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-md-3">
                                                    <form action="{{ url('admin/users', $user->id) }}" method="POST" class="form-inline" onsubmit="return confirmDelete();">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-danger btn-xs" title="Banear" @if($user->role == 'admin') disabled @endif>
                                                            <i class="fa fa-ban"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3 col-offset-3">
                                                    <form action="{{ url('admin/users', $user->id) }}" method="POST" class="form-inline" onsubmit="return confirmAction();">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PATCH') }}
                                                        <button type="submit" class="btn btn-success btn-xs" title="Volver admin" disabled>
                                                            <i class="fa fa-magic"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-md-3">
                                                    <form action="{{ url('admin/users', $user->id) }}" method="POST" class="form-inline">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <button type="submit" class="btn btn-primary btn-xs" title="Activar" @if($user->role == 'admin') disabled @endif>
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
   function confirmDelete(){
       if (!confirm("¿Estás seguro que deseas banear el usuario?")) {
           return false;
       }
   }
   function confirmAction(){
       if (!confirm("¿Estás seguro que desea convertirlo en administrador?")) {
           return false;
       }
   }
</script>
