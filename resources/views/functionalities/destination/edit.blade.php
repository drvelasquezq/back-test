@extends('adminlte::page')

@section('title', 'Editar un destino')

@section('content_header')
    <h1>Editar un destino</h1>
@stop

@section('content')
<div class="col-md-8">
    <!-- Horizontal Form -->
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Formulario para editar un destino</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="{{ route('destinations.update', $destination->id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="box-body">
          
          <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="Nombre"
                     value="{{ $errors->has('name') ? old('name') : $destination->name }}">
              @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>  
              @endif
            </div>
          </div>

          <div class="form-group {{ $errors->has('sales_strategy') ? 'has-error' : ''}}">
            <label for="sales_strategy" class="col-sm-2 control-label">Estrategia de ventas</label>
            <div class="col-sm-10">
              <textarea id="editor" name="sales_strategy" rows="10" cols="80">
                  {{ $errors->has('sales_strategy') ? old('sales_strategy') : $destination->sales_strategy }}
              </textarea>
              @if ($errors->has('sales_strategy'))
                <span class="help-block">{{ $errors->first('sales_strategy', ':message') }}</span>
              @endif
            </div>
          </div>

          <div class="form-group {{ $errors->has('latitude') ? 'has-error' : ''}}">
            <label for="latitude" class="col-sm-2 control-label">Latitud</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="latitude" name="latitude"
                     placeholder="Grados decimales, ingresar por ejemplo: 4.607351 | El valor es entre -90 y 90"
                     value="{{ $errors->has('latitude') ? old('latitude') : $destination->latitude }}">
              @if ($errors->has('latitude'))
                <span class="help-block">{{ $errors->first('latitude', ':message') }}</span>  
              @endif
            </div>
          </div>

          <div class="form-group {{ $errors->has('longitude') ? 'has-error' : ''}}">
            <label for="longitude" class="col-sm-2 control-label">Longitud</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="longitude" name="longitude"
                     placeholder="Grados decimales, por ejemplo: -74.207339 | El valor es entre -180 y 180"
                     value="{{ $errors->has('longitude') ? old('longitude') : $destination->longitude }}">
              @if ($errors->has('longitude'))
                <span class="help-block">{{ $errors->first('longitude', ':message') }}</span>  
              @endif
            </div>
          </div>

          <div class="form-group {{ $errors->has('department') ? 'has-error' : ''}}">
            <label for="department" class="col-sm-2 control-label">Departamento</label>
            <div class="col-sm-10">
                <select class="form-control select2" name="department" style="width: 100%;">
                    <option value="">Seleccionar el departamento del destino</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                                {{ $errors->has('department') ? (old('department') == $department->id ? 'selected' : '') : ($destination->department->id == $department->id ? 'selected' : '') }}
                                {{ old('department') == $department->id ? 'selected' : ''}}>
                                {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('department'))
                  <span class="help-block">{{ $errors->first('department', ':message') }}</span>  
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

@section('js')
  <script>
    CKEDITOR.replace('editor');
    $('.select2').select2()
  </script>
@stop