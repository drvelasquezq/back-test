@extends('adminlte::page')

@section('title', 'Crear una región')

@section('content_header')
    <h1>Crear una región</h1>
@stop

@section('content')
<div class="col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Formulario para crear una región</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="{{ route('regions.store') }}">
        {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-sm-2 control-label">Nombre</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="Nombre"
                     value="{{ old('name') }}">
              @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>  
              @endif
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a class="btn btn-default" href="{{ route('regions.index') }}" role="button">
            Cancelar
          </a>
          <button class="btn btn-primary pull-right" type="submit">Crear</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
    <!-- /.box -->
</div>
@stop





