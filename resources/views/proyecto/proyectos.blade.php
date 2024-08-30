@extends('adminlte::page')
@section('title', 'Proyectos')
@section('content_header')
    <div class="mt-1"></div>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/extras.css') }}">
@stop
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">
                    Proyectos
                    @can('Proyectos_Crear')
                    <a href="{{ route('proyecto.create') }}" class="btn btn-primary float-right">Agregar</a>
                    @endcan
                </h5>
            </div>
            <div class="card-body">
                @php
                    $heads = [
                        'Código',
                        'Estado',
                        'Nombre',
                        'Fecha Inicio',
                        'Fecha Finalización',
                        ['label' => 'Acciones', 'no-export' => true, 'width' => 16],
                    ];
                    $config = ['language' => ['url' => 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json']]; 
                @endphp
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" class="small-text-table">
                    @foreach ($proyectos as $proyecto)
                        <tr>
                            <td>{{ $proyecto->codigo }}</td>
                            <td>
                                <div class="text-center {{ $proyecto->estado_css }}">
                                    {{ $proyecto->estado }}
                                </div>
                            </td>
                            <td>{{ $proyecto->nombre }}</td>
                            <td>{{ $proyecto->fecha_inicio }}</td>
                            <td>{{ $proyecto->fecha_finalizacion }}</td> 
                            <td>
                                @php
                                    $data = ['p_i' => $proyecto->id, 'p_n' => $proyecto->nombre];
                                @endphp
                                @can('Proyectos_Ver')
                                <a href="{{ route('proyecto.show', ['proyecto' => $proyecto->id]) }}"
                                    class="btn btn-xs btn-info" title="Ver">
                                    @include('iconoSVG.look')
                                </a>
                                @endcan
                                @can('Proyectos_Editar')
                                <a href="{{ route('proyecto.edit', ['proyecto' => $proyecto->id]) }}"
                                    class="btn btn-xs btn-green" title="Editar">
                                    @include('iconoSVG.edit')
                                </a>
                                @endcan
                                @can('Proyectos_Eliminar')
                                <form style="display: inline"
                                    action="{{ route('proyectos.eliminar_proyecto', $proyecto->id) }}" method="POST"
                                    class="formEliminar">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-xs btn-fucsia" title="Eliminar">
                                        @include('iconoSVG.delete')</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>

            </div>
        </div>
    </div>
@stop

@include('recursos.respuestas')
