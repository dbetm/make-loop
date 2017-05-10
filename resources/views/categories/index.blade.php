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
                <div class="panel-heading head"> <b>Categorías</b>
                    <a href="{{ url('admin/categories/create') }}" class="btn btn-primary pull-right">
                        <i class="fa fa-plus"></i> Crear
                    </a>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th>Nombre</th>
                            <th>Es activa</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    @if($category->is_active == 1)
                                        <td>Sí</td>
                                    @else
                                        <td>No</td>
                                    @endif
                                    <td>
                                        <div class="row">
                                            <div class="col-md-3 col-offset-3">
                                                <a href="{{ url('admin/categories', $category->id) }}" class="btn btn-success btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <form action="{{ url('admin/categories', $category->id) }}" method="POST" class="form-inline" onsubmit="return confirmDelete();">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
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
       if (!confirm("¿Estás seguro que deseas eliminar la categoría?")) {
           return false;
       }
   }
</script>
