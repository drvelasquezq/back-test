@extends('adminlte::page')

@section('title', 'Filtro de destinos')

@section('content_header')
    <h1>Filtro de destinos</h1>
@stop

@section('content')


<div class="box">
    <div class="box-body">

        <form class="form-inline" id="form-search-destinations" method="GET" action="#">
            <div class="form-group">
              <label for="region">Región: </label>
              <select class="form-control select2" name="region" id="region">
                <option value="">Seleccionar la región del departamento</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}"
                            {{ $idRegionSelected == $region->id ? 'selected' : ''}}>
                            {{ $region->name }}
                    </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                <label for="department">Departamento: </label>
                <select class="form-control select2" name="department" id="department">
                  <option value="">Seleccionar el departamento del destino</option>
                  @foreach ($departments as $department)
                      <option value="{{ $department->id }}"
                              {{ $idDepartmentSelected == $department->id ? 'selected' : ''}}>
                              {{ $department->name }}
                      </option>
                  @endforeach
                </select>
            </div>
        </form>

    </div>
</div>

<div class="box">
    <div class="box-header">
      <h3 class="box-title">Tabla con los destinos filtrados</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="destinations" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Región</th>
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
                        <a href="{{ route('regions.show', ['region' => $destination->department->region->id]) }}" class="btn btn-default btn-xs"
                           title="Ver la región - ID: {{ $destination->department->region->id }} - Nombre: {{ $destination->department->region->name }}">
                             <i class="fas fa-eye"></i>
                        </a>
                        <strong>ID:</strong> {{ $destination->department->region->id }} - <strong>Nombre:</strong> {{ $destination->department->region->name }} 
                    </td>

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
    var table = $('#destinations').DataTable();
    $('.select2').select2();

    $('#region').change(function () {
        $("#department option[value='']").attr('selected', true);
        $("#form-search-destinations").submit();
    });

    $('#department').change(function () {
        $("#form-search-destinations").submit();
    });
  </script>
@stop