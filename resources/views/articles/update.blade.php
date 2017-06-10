@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading clearfix"> <h4 class="panel-title pull-left panelUp"><b>Editando artículo</b></h4>
                    <a href="{{ url('articles/index') }}" class="btn btn-primary pull-right">
                        <i class="fa fa-th-list"></i> Ver artículos
                    </a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('articles', $article->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $article->name) }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Estado del artículo</label>
                            <div class="col-md-2">
                                <select class="selectpicker form-control" name="status" id="status">
                                    <option value="good" @if (old('status', $article->status) == 'good') selected="selected" @endif>Bueno</option>
                                    <option value="new" @if (old('status', $article->status) == 'new') selected="selected" @endif>Nuevo</option>
                                    <option value="regular" @if (old('status', $article->status) == 'regular') selected="selected" @endif >Regular</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id" class="col-md-4 control-label">Categoría</label>
                            <div class="col-md-2">
                                <select class="form-control selectpicker" name="category_id" id="category_id">
                                    @foreach($categories as $category)
                                        @if($category->is_active == 0)
                                            <option value="{{ $category->id }}" disabled>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}" {{ (collect(old('category_id', $article->category_id))->contains($category->id)) ? 'selected':'' }}>{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('points') ? ' has-error' : '' }}">
                            <label for="points" class="col-md-4 control-label">Puntos</label>
                            <div class="col-md-2">
                                <input id="points" type="number" min="1" max="100" class="form-control" name="points" value="{{ old('points', $article->points) }}">
                                @if ($errors->has('points'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('points') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <p>La cantidad de puntos por los cuales se intercambia el artículo.</p>
                        </div>
                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Precio</label>
                            <div class="col-md-2">
                                <input id="price" type="number" class="form-control" name="price" value="{{ old('price', $article->price) }}" placeholder="$ Opcional">
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Descripción</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description" rows="4">{{ old('description', $article->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Imagen</label>
                            <div class="col-md-6">
                                <input id="image" type="text" class="form-control" name="image" value="{{ old('image', $article->image) }}" placeholder="URL">
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox" name="is_active">
                                    <label>
                                        <input type="checkbox" name="is_active" value="1" @if(old('is_active',$article->is_active)) checked @endif> Publicar al guardar
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i> Guardar cambios
                                </button>
                                <button type="reset" class="btn btn-default">
                                    <i class="fa fa-btn fa-eraser"></i> Limpiar
                                </button>
                            </div>
                        </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
