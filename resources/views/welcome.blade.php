@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido</div>
                    <div class="container col-md-12">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                             <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">

                                <div class="item active">
                                    <img src="{!!asset('img/present.jpg')!!}" style="width:100%;">
                                    <div class="carousel-caption">
                                        <h3>Movimiento verde</h3>
                                        <p>Cuidemos el planeta.</p>
                                    </div>
                                </div>

                                <div class="item">
                                    <img src="{!!asset('img/share.jpg')!!}" style="width:100%;">
                                    <div class="carousel-caption">
                                        <h3>MAKE LOOP</h3>
                                        <p>Para la comunidad que ama compartir y ayudar.</p>
                                    </div>
                                </div>

                                <div class="item">
                                    <img src="{!!asset('img/help.jpg')!!}" style="width:100%;">
                                    <div class="carousel-caption">
                                        <h3>Encuentra lo que necesitas...</h3>
                                        <p>pero no olvides ayudar a los demás.</p>
                                    </div>
                                </div>
                            </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
