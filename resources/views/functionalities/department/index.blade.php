@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content_header')
    <h1>Departamentos</h1>
@stop

@section('content')
<div class="box">
  <div class="box-body">
    <a class="btn btn-primary btn-lg" href="{{ route('departments.create') }}" role="button">Crear un departamento</a>
  </div>
</div>

@if (session()->has('flash'))
  <div class="alert alert-success" role="alert">{{ session('flash') }}</div>
@endif

<div class="box">
    <div class="box-header">
      <h3 class="box-title">Tabla con todos los departamentos</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="departments" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Region</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{ route('regions.show', ['region' => $department->region->id]) }}" class="btn btn-default btn-xs"
                           title="Ver la región - ID: {{ $department->region->id }} - Nombre: {{ $department->region->name }}">
                             <i class="fas fa-eye"></i>
                        </a>
                        <strong>ID:</strong> {{ $department->region->id }} - <strong>Nombre:</strong> {{ $department->region->name }} 
                    </td>
                    <td align="center">
                        <a href="{{ route('departments.show', ['department' => $department->id]) }}" class="btn btn-info btn-sm"
                           title="Ver el departamento - ID: {{ $department->id }} - Nombre: {{ $department->name }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can ('update-destroy-user-equals', $department)
                          <a href="{{ route('departments.edit', ['department' => $department->id]) }}" class="btn btn-warning btn-sm"
                             title="Editar el departamento - ID: {{ $department->id }} - Nombre: {{ $department->name }}">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="{{ route('departments.eliminate', ['department' => $department->id]) }}" class="btn btn-danger btn-sm"
                             title="Eliminar el departamento - ID: {{ $department->id }} - Nombre: {{ $department->name }}">
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
    var table = $('#departments').DataTable()
  </script>
@stop

