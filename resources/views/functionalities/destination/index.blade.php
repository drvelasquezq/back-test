@extends('adminlte::page')

@section('title', 'Destinos')

@section('content_header')
    <h1>Destinos</h1>
@stop

@section('content')
<div class="box">
  <div class="box-body">
    <a class="btn btn-primary btn-lg" href="{{ route('destinations.create') }}" role="button">Crear un destino</a>
  </div>
</div>

@if (session()->has('flash'))
  <div class="alert alert-success" role="alert">{{ session('flash') }}</div>
@endif

<div class="box">
    <div class="box-header">
      <h3 class="box-title">Tabla con todos los destinos</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="destinations" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Departamento</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($destinations as $destination)
                <tr>
                    <td>{{ $destination->id }}</td>
                    <td>{{ $destination->name }}</td>
                    <td>
                        <a href="{{ route('departments.show', ['department' => $destination->department->id]) }}" class="btn btn-default btn-xs"
                           title="Ver el departamento - ID: {{ $destination->department->id }} - Nombre: {{ $destination->department->name }}">
                             <i class="fas fa-eye"></i>
                        </a>
                        <strong>ID:</strong> {{ $destination->department->id }} - <strong>Nombre:</strong> {{ $destination->department->name }} 
                    </td>
                    <td align="center">
                        <a href="{{ route('destinations.show', ['destination' => $destination->id]) }}" class="btn btn-info btn-sm"
                           title="Ver el destino - ID: {{ $destination->id }} - Nombre: {{ $destination->name }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can ('update-destroy-user-equals', $destination)
                          <a href="{{ route('destinations.edit', ['destination' => $destination->id]) }}" class="btn btn-warning btn-sm"
                             title="Editar el destino - ID: {{ $destination->id }} - Nombre: {{ $destination->name }}">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="{{ route('destinations.eliminate', ['destination' => $destination->id]) }}" class="btn btn-danger btn-sm"
                             title="Eliminar el destino - ID: {{ $destination->id }} - Nombre: {{ $destination->name }}">
                            <i class="fas fa-times"></i>
                          </a>
                        @else
                          <i class="far fa-question-circle" title="No puede Editar o Eliminar el registro debido a que fue creado por otro usuario"></i>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
</div>
@stop

@section('js')
  <script>
    var table = $('#destinations').DataTable()
  </script>
@stop

