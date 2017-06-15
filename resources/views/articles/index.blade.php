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
                <div class="panel-heading clearfix"> <h4 class="panel-title pull-left panelUp"><b>Mis artículos</b></h4>
                    <div class="row">
                        <div class="col-lg-4 pull-right">
                            <form action="{{ url('articles/index') }}" method="GET" role="search">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="arg" placeholder="Escriba algo">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search "></span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <a href="{{ url('articles/create') }}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Nuevo
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">
                        @foreach($articles as $article)
                        <div class="col-xs-18 col-sm-6 col-md-3">
                             <div class="thumbnail">
                                <img src="{{ $article->image }}" class="img-responsive center-block">
                                <div class="caption">
                                    <h4><b>{{ $article->name }}</b></h4>
                                    <p>{{ $article->description }}</p>
                                    <p> Puntos: {{ $article->points }}
                                    <p> {{ "Estado:" }}
                                        @if($article->status == 'new')
                                            {{ "Nuevo" }}
                                        @elseif($article->status == 'good')
                                            {{ "Bueno" }}
                                        @else
                                            {{ "Regular" }}
                                        @endif
                                    </p>
                                        @if($article->price)
                                    <p> ${{ $article->price }} @endif </p>
                                    <div class="row">
                                        <div class="col-md-3 col-offset-3">
                                            <a href="{{ url('articles', $article->id) }}" class="btn btn-success btn-sm" title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>

                                        <div class="col-md-3">
                                            <form action="{{ url('articles', $article->id) }}" method="POST" class="form-inline" onsubmit="return confirmDelete();">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Borrar">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="col-md-3">
                                            <form action="{{ url('articles', $article->id) }}" method="POST" class="form-inline">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                @if($article->is_active == '0')
                                                    <input type="submit" class="btn btn-primary btn-xs" value="Publicar">
                                                @else
                                                    <input type="submit" class="btn btn-warning btn-xs" value="Ocultar">
                                                @endif
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="{{ $article->image }}" alt="Hola" class="img-responsive">
                                <div class="caption">
                                    <h3>{{ $article->name }}</h3>
                                    <p> Puntos: {{ $article->points }}
                                    <p> {{ "Estado:" }}
                                        @if($article->status == 'new')
                                            {{ "Nuevo" }}
                                        @elseif($article->status == 'good')
                                            {{ "Bueno" }}
                                        @else
                                            {{ "Regular" }}
                                        @endif
                                    </p>
                                        @if($article->price)
                                    <p> ${{ $article->price }} @endif </p>
                                    <p> {{ $article->description }} </p>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-3 col-offset-3">
                                                <a href="{{ url('articles', $article->id) }}" class="btn btn-success btn-sm" title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <form action="{{ url('articles', $article->id) }}" method="POST" class="form-inline" onsubmit="return confirmDelete();">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Borrar">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-3">
                                                <form action="{{ url('articles', $article->id) }}" method="POST" class="form-inline">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                    @if($article->is_active == '0')
                                                        <input type="submit" class="btn btn-primary btn-xs" value="Publicar">
                                                    @else
                                                        <input type="submit" class="btn btn-warning btn-xs" value="Ocultar">
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        --}}

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
   function confirmDelete(){
       if (!confirm("¿Estás seguro que deseas eliminar el artículo?")) {
           return false;
       }
   }
</script>
