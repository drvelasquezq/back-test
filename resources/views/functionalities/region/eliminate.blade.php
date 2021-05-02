@extends('adminlte::page')

@section('title', 'Eliminar región')

@section('content_header')
    <h1>Eliminar región</h1>
@stop

@section('content')

<div class="col-md-6">
    <div class="box box-danger">
        <div class="box-body">
            <div class="box box-default collapsed-bo">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>ID</strong></h3>
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
            <button id="btn-eliminate" class="btn btn-danger pull-right" type="button">Eliminar</button>
        </div>
        <form id="form-eliminate" class="form-horizontal" method="POST" action="{{ route('regions.destroy', $region->id) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
    </div>
</div>
@stop

@section('js')
  <script>
    $("#btn-eliminate").click(function () {
        swal({
            title: '¿Está seguro?',
            text: 'Se eliminará la región seleccionada, así como también los departamentos y los destinos de estos departamentos.',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            buttons: ['Cancelar', 'Sí, deseo eliminar']
        }).then((willDelete) => {
            if (willDelete) {
                $("#form-eliminate").submit()
            }
        });
    });
  </script>
@stop





