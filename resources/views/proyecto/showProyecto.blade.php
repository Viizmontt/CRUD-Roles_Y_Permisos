@extends('adminlte::page')

@section('title', 'Información del Proyecto')

@section('content_header')
    <div class="mt-1"></div>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css">
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Información del Proyecto: {{ $proyecto->nombre }}</h5>
            </div>

            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="codigo">Código:</label>
                        <input type="text" class="form-control" id="codigo" value="{{ $proyecto->codigo }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" value="{{ $proyecto->nombre }}" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="agencia">Países Cooperante:</label>
                            <input type="text" class="form-control" id="agencia"
                                value="{{ $proyecto->codigoAgencia }} - {{ $proyecto->nombreAgencia }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="fechaInicio">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fechaInicio" value="{{ $proyecto->fecha_inicio }}"
                                readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="meses">Duración en meses:</label>
                            <input type="num" class="form-control" id="meses" value="{{ $proyecto->meses }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="fechaInicio">Fecha Finalización</label>
                            <input type="date" class="form-control" id="fechaInicio" value="{{ $proyecto->fecha_finalizacion }}"
                                readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="prorroga">Fecha de Prórroga:</label>
                            <input type="date" class="form-control" id="prorroga"
                                value="{{ $proyecto->prorroga_at }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="objetivoGeneral">Objetivo General:</label>
                        <textarea id="editor1" readonly>{{ $proyecto->objetivo_general }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="detalle">Detalle:</label>
                        <textarea id="editor2" readonly>{{ $proyecto->descripcion }}</textarea>
                    </div>
                </form>
                <div class="modal-footer">
                    <a href="{{ route('proyecto.index') }}" class="btn btn-danger float-right"
                        style="margin-right: 1mm;">Regresar</a>
                </div>
            </div>

        </div>
    </div>

@stop

@include('recursos.editor')
