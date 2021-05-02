@extends('adminlte::page')

@section('title', 'Editar una región')

@section('content_header')
    <h1>Editar una región</h1>
@stop

@section('content')
<div class="col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Formulario para editar una región</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="{{ route('regions.update', $region->id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="box-body">
          <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-sm-2 control-label">Nombre</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="Nombre"
                     value="{{ $errors->has('name') ? old('name') : $region->name }}">
              @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>  
              @endif
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a class="btn btn-default" href="{{ url()->previous() }}" role="button">
            Cancelar
          </a>
          <button class="btn btn-warning pull-right" type="submit">Editar</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
    <!-- /.box -->
    @if ($errors->has('general'))
      <div class="alert alert-warning" role="alert">{{ $errors->first('general', ':message') }}</div>
    @endif
</div>
@stop