@extends('adminlte::page')

@section('title', 'Regiones')

@section('content_header')
    <h1>Regiones</h1>
@stop

@section('content')
<div class="box">
  <div class="box-body">
    <a class="btn btn-primary btn-lg" href="{{ route('regions.create') }}" role="button">Crear una región</a>
  </div>
</div>

@if (session()->has('flash'))
  <div class="alert alert-success" role="alert">{{ session('flash') }}</div>
@endif

<div class="box">
    <div class="box-header">
      <h3 class="box-title">Tabla con todas las regiones</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="regions" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($regions as $region)
                <tr>
                    <td>{{ $region->id }}</td>
                    <td>{{ $region->name }}</td>
                    <td align="center">
                        <a href="{{ route('regions.show', ['region' => $region->id]) }}" class="btn btn-info btn-sm"
                           title="Ver la región - ID: {{ $region->id }} - Nombre: {{ $region->name }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can ('update-destroy-user-equals', $region)
                          <a href="{{ route('regions.edit', ['region' => $region->id]) }}" class="btn btn-warning btn-sm"
                             title="Editar la región - ID: {{ $region->id }} - Nombre: {{ $region->name }}">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="{{ route('regions.eliminate', ['region' => $region->id]) }}" class="btn btn-danger btn-sm"
                             title="Eliminar la región - ID: {{ $region->id }} - Nombre: {{ $region->name }}">
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
    var table = $('#regions').DataTable()
  </script>
@stop

