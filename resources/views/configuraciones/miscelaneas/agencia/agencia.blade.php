@extends('adminlte::page')
@section('title', 'Países Cooperantes')
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
                    Países Cooperantes
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#agregarAgencia"style="margin-right: 1mm;">Agregar</button>
                </h5>
            </div>
            <div class="card-body">
                @php
                    $heads = [
                        'Id',
                        'Código',
                        'Nombre',
                        'Detalle',
                        'Acciones',
                    ];
                    $config = config('datatables.default');
                @endphp
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                    @foreach ($agencias as $agencia)
                        <tr>
                            <td>{{ $agencia->id }}</td>
                            <td>{{ $agencia->codigo }}</td>
                            <td>{{ $agencia->nombre }}</td>
                            <td>{{ $agencia->detalle }}</td>
                            <td>
                                <button type="button" id="{{ $agencia->id }}" name="{{ $agencia->nombre }}"
                                    codigo="{{ $agencia->codigo }}" detalle="{{ $agencia->detalle }}"
                                    class="btn btn-xs btn-green open-modal" data-toggle="modal" data-target="#editarAgencia"
                                    style="margin-right: 1mm;">
                                    @include('iconoSVG.edit')
                                </button>

                                <form style="display: inline" action="{{ route('agencia.destroy', $agencia->id) }}" method="POST"
                                    class="formEliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-fucsia" title="Eliminar">@include('iconoSVG.delete')</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>

                <div class="modal fade" id="agregarAgencia" tabindex="-1" role="dialog"
                    aria-labelledby="agregarAgencialLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarAgencialLabel">Guardar País</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('agencia.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="url">Código: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="codigo" placeholder="Ingrese el código" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="url">Nombre: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Ingrese el nombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Detalle:</label>
                                        <textarea class="form-control" name="detalle" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editarAgencia" tabindex="-1" role="dialog"
                    aria-labelledby="editarAgencialLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarAgenciaLabel">Editar País</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @php $id = 1; @endphp
                                <form action="{{ route('agencia.update', ['agencium' => $id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <label for="url">Código: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="codigo" placeholder="Ingrese el código" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="url">Nombre: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Ingrese el nombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Detalle:</label>
                                        <textarea class="form-control" name="detalle" rows="3"> </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
@include('recursos.modalRespuestas')
