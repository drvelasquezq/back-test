@extends('adminlte::page')

@section('title', 'Un departamento')

@section('content_header')
    <h1>Deparamento</h1>
@stop

@section('content')

<div class="col-md-6">
    <div class="box box-info">
        <div class="box-body">
            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>ID</strong></h3>

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

                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                    {{ $department->id }}
                </div>    
            </div>
            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Nombre</strong></h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                    {{ $department->name }}
                </div>    
            </div>

            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Región</strong></h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                    ID: {{ $department->region->id }} - Nombre: {{ $department->region->name }}
                </div>    
            </div>

            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Usuario</strong></h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                    ID: {{ $department->user->id }} - Nombre: {{ $department->user->name }}
                </div>    
            </div>
        </div>
        <div class="box-footer">
            <a class="btn btn-default" href="{{ url()->previous() }}" role="button">
              Volver
            </a>
        </div>
    </div>
</div>
@stop