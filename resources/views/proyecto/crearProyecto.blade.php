@extends('adminlte::page')

@section('title', 'Nuevo Proyecto')

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
            <h5 class="text-center">Crear Proyecto</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('proyecto.store') }}" method="post"> 
                @csrf  

                <div class="mb-3">
                      <label class="form-label">Países Cooperante: <span class="text-danger">*</span></label>
                      <select name="agencia" id="agencia" class="form-control">
                        @foreach ($agencias as $agencia)
                          <option value="{{ $agencia->id }}">{{$agencia->codigo}} - {{$agencia->nombre}}</option>
                        @endforeach
                      </select>
                </div>
                  
                <div class="mb-3">
                    <label class="form-label">Nombre: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Fecha de Inicio: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fechaI" name="fechaI" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Duración en meses: <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="meses" name="meses" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Fecha de Finalización: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fechaF" name="fechaF">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Objetivo general: <span class="text-danger">*</span></label>
                    <textarea id="editor1" name="objetivo"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Detalle:</label>
                    <textarea id="editor2" name="descripcion"> </textarea>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary float-right">Agregar</button>
                    <a href="{{ route('proyecto.index') }}" class="btn btn-danger float-right" style="margin-right: 1mm;">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@include('recursos.editor')

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const fechaInicioInput = document.getElementById('fechaI');
            const mesesInput = document.getElementById('meses');
            const fechaFinInput = document.getElementById('fechaF');
            function actualizarFechaFin() {
                const fechaInicio = new Date(fechaInicioInput.value);
                const meses = parseInt(mesesInput.value, 10);
                if (isNaN(fechaInicio.getTime()) || isNaN(meses)) {
                    return;
                }
                const fechaFin = new Date(fechaInicio);
                fechaFin.setMonth(fechaFin.getMonth() + meses);
                // Ajustar el formato de la fecha a yyyy-mm-dd
                const year = fechaFin.getFullYear();
                const month = String(fechaFin.getMonth() + 1).padStart(2, '0');
                const day = String(fechaFin.getDate()).padStart(2, '0');
                fechaFinInput.value = `${year}-${month}-${day}`;
            }
            mesesInput.addEventListener('input', actualizarFechaFin);
            fechaInicioInput.addEventListener('change', actualizarFechaFin);
            // Inicializar la fecha de finalización al cargar la página
            actualizarFechaFin();
        });
    </script>
@endsection