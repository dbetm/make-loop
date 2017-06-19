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
                <div class="panel-heading clearfix"> <h4 class="panel-title pull-left panelUp"><b>Intercambios que me han solicitado.</b></h4>
                    <button type="button" class="btn btn-primary pull-right">Le han solicitado: &nbsp;<span class="badge"> {{ $howinter }} </span>&nbsp; artículos.</button>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Puntos</th>
                            <th>Artículo</th>
                            <th>Usuario que solicita</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($interchanges as $interchange)
                                <tr>
                                    <td>{{ $interchange->id }}</td>
                                    @if($interchange->status == 'solicited')
                                        <td>Solicitado</td>
                                    @elseif($interchange->status == 'checked')
                                        <td>Entregado</td>
                                    @elseif($interchange->status == 'sending')
                                        <td>Ya lo has enviado</td>
                                    @else
                                        <td>Cancelado</td>
                                    @endif
                                    <td> {{ $interchange->points }} </td>
                                    <td>{{ $interchange->artName }}</td>
                                    <td>{{ $interchange->username }} {{ $interchange->userlastname }}</td>
                                    <td>
                                        <div class="row btn-group">
                                            <div class="col-md-3">
                                                <form action="{{ url('interchange', $interchange->id) }}" method="POST" class="form-inline" onsubmit="return confirmDelete();">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger btn-xs" title="Cancelar" @if($interchange->status == 'canceled' or $interchange->status == 'checked') disabled @endif>
                                                        <i class="fa fa-ban"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-3">
                                                <form action="{{ url('interchange', $interchange->id) }}" method="POST" class="form-inline" onsubmit="return confirmSend();">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <button type="submit" class="btn btn-success btn-xs" title="Enviar" @if($interchange->status == 'canceled' or $interchange->status == 'checked' or $interchange->status == 'sending') disabled @endif>
                                                        <i class="fa fa-send"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-3 col-offset-3">
                                                <a href="#" class="btn btn-primary btn-xs" title="Mandar mensajes">
                                                    <i class="fa fa-comments"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
   function confirmDelete(){
       if (!confirm("¿Estás seguro que deseas cancelar el intercambio?")) {
           return false;
       }
   }

   function confirmSend(){
       if (!confirm("¿Con esto confirmas que se está enviando el artículo?")) {
           return false;
       }
   }
</script>
