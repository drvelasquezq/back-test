@extends('adminlte::page')

@section('title', 'Crear un destino')

@section('content_header')
    <h1>Crear un destino</h1>
@stop

@section('content')
<div class="col-md-8">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Formulario para crear un destino</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="{{ route('destinations.store') }}">
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

          <div class="form-group {{ $errors->has('sales_strategy') ? 'has-error' : ''}}">
            <label for="sales_strategy" class="col-sm-2 control-label">Estrategia de ventas</label>
            <div class="col-sm-10">
              <textarea id="editor" name="sales_strategy" rows="10" cols="80">
                  {{ old('sales_strategy') }}
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
                     value="{{ old('latitude') }}">
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
                     value="{{ old('longitude') }}">
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
          <button class="btn btn-primary pull-right" type="submit">Crear</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
    <!-- /.box -->
</div>
@stop

@section('js')
  <script>
    CKEDITOR.replace('editor');
    $('.select2').select2()
  </script>
@stop