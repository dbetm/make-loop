@extends('layouts.app')

@section('content')
<!-- Styles -->
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissable">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
        <div class="col-md-5  toppad  pull-right col-md-offset-3">
            <p class=" text-info">Última actualización: {{ $user->updated_at }}</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Perfil de usuario</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{ $user->image }}" class="img-circle img-responsive"> </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Apellido(s):</td>
                                        <td>{{ $user->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Puntos:</td>
                                        <td><b>{{ $user->points }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Rol:</td>
                                        @if($user->role == 'admin')
                                            <td>Administrador</td>
                                        @else
                                            <td>Usuario normal</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><u>{{ $user->email }}</u></td>
                                    </tr>
                                        <td>Biografía:</td>
                                        <td>{{ $user->bio }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="{{ url('/users/profile', $user->id) }}" title="Editar datos" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="{{ url('/users/profile/pass', $user->id) }}" title="Cambiar contraseña" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-lock"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- JavaScripts -->
<script src="{{ asset('assets/js/profile.js') }}"></script>
