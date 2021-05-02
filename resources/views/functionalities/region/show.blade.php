@extends('adminlte::page')

@section('title', 'Una región')

@section('content_header')
    <h1>Región</h1>
@stop

@section('content')

<div class="col-md-6">
    <div class="box box-info">
        <div class="box-body">
            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>ID</strong></h3>

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

                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                    {{ $region->id }}
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
                    {{ $region->name }}
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
                    ID: {{ $region->user->id }} - Nombre: {{ $region->user->name }}
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







