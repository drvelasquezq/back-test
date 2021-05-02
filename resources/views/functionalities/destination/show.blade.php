@extends('adminlte::page')

@section('title', 'Un destino')

@section('content_header')
    <h1>Destino</h1>
@stop

@section('content')

<div class="col-md-4">
    <div class="box box-info">
        <div class="box-body">
            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>ID</strong></h3>

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

                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                    {{ $destination->id }}
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
                    {{ $destination->name }}
                </div>    
            </div>

            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Latitud,Longitud</strong></h3>
                    <small>(En grados decimales)</small>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                    <a href="https://www.google.com/maps/{{ '@'.$destination->latitude }},{{ $destination->longitude }},20z" class="btn btn-info btn-xs"
                       title="Ver"
                       target="blank">
                      <i class="fas fa-map-marker-alt"></i>
                    </a>
                    {{ $destination->latitude }}, {{ $destination->longitude }}
                </div>    
            </div>

            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Latitud,Longitud</strong></h3>
                    <small>(En grados con minutos y segundos)</small>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                    <a href="https://www.google.com/maps/{{ '@'.$destination->latitude }},{{ $destination->longitude }},20z" class="btn btn-info btn-xs"
                       title="Ver"
                       target="blank">
                      <i class="fas fa-map-marker-alt"></i>
                    </a>
                    {{ $coordinates['latitude']['degrees'] }}°{{ $coordinates['latitude']['minutes'] }}'{{ $coordinates['latitude']['seconds'] }}''{{ $coordinates['latitude']['coordinate'] }}
                    {{ $coordinates['longitude']['degrees'] }}°{{ $coordinates['longitude']['minutes'] }}'{{ $coordinates['longitude']['seconds'] }}''{{ $coordinates['longitude']['coordinate'] }}
                </div>    
            </div>

            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Departamento</strong></h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                    ID: {{ $destination->department->id }} - Nombre: {{ $destination->department->name }}
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
                    ID: {{ $destination->user->id }} - Nombre: {{ $destination->user->name }}
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
<div class="col-md-8">
    <div class="box box-info">
        <div class="box-body">

            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Estrategia de ventas</strong></h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                    {!! $destination->sales_strategy !!}
                </div>    
            </div>

        </div>    
    </div>
@stop