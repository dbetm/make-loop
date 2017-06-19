@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissable">
                    {{ session()->get('message') }}
                </div>
            @elseif(session()->has('notice'))
                <div class="alert alert-danger alert-dismissable">
                    {{ session()->get('notice') }}
                </div>
            @endif
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="row clearfix">
                <div class="col-lg-5 pull-right panelUp2">
                    <form action="#" method="GET" role="search">
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
                <h1 class="text-left ">Gabinete</h1>

                <div class="list-group">
                @forelse($articles as $article)
                    @empty
                    <h2>Ningún artículo encontrado.</h2>
                @endforelse
                @foreach($articles as $article)
                    @if($article->user->is_active == '0' or $article->trans == 1)
                        @continue
                    @endif
                    <div class="row">
                        <a class="list-group-item">
                            <div class="media col-md-3">
                                <figure class="pull-left">
                                    <img class="media-object img-rounded img-responsive" src="{{ $article->image }}" alt="Foto del artículo">
                                </figure>
                            </div>
                            <div class="col-md-6">
                                <h4 class="list-group-item-heading"> {{ $article->name }} </h4>
                                <p class="list-group-item-text">
                                    <p>
                                        <span class="label label-info">{{ $article->category->name }}</span>
                                    </p>

                                    @if($article->price)<p> <small> <b>Precio de referencia:</b> {{ $article->price }} </small> <p> @endif
                                    {{ $article->description }}
                                    <p></p>
                                    @if($user->id != $article->user->id)
                                        <p class="text-muted">{{ $article->user->name }} {{ $article->user->last_name }}</p>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-3 text-center">
                                <h2> {{ $article->points }} <small> puntos </small></h2>
                                {{-- <span class="label label-info">{{ $category->name }}</span> hacer inner join para traerme el nombre --}}
                                <form action="{{ url('/home', $article->id) }}" method="POST" class="form-inline">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    @if($user->id != $article->user->id and $article->was_deleted != 1)
                                        <button type="submit" class="btn btn-primary btn-lg btn-block"> <b>¡Lo quiero! </b> </button>
                                    @else
                                        <h2><span class="label label-info">Es tuyo</span></h2>
                                    @endif
                                </form>
                                <div class="stars">
                                    @if($article->status == 'new')
                                        @for ($i = 0; $i < 5; $i++)
                                            <span class="glyphicon glyphicon-star"></span>
                                        @endfor
                                    @elseif($article->status == 'good')
                                        @for ($i = 0; $i < 3; $i++)
                                            <span class="glyphicon glyphicon-star"></span>
                                        @endfor
                                    @else
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                    @endif
                                </div>
                                <p>
                                    @if($article->status == 'new')
                                        {{ "Nuevo" }}
                                    @elseif($article->status == 'good')
                                        {{ "Bueno" }}
                                    @else
                                        {{ "Regular" }}
                                    @endif
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
                {!! $articles->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
