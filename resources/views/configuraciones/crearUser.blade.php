@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
    <h1>Crear Usuario</h1>
@stop

@section('content')

    <div class="container mt-5">
        <form action="{{ route('asignar.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electronico:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary float-right">Agregar Usuario</button>
            <button type="button" onclick="window.location.href='{{-- route('proyecto.index') --}}'" class="btn btn-dark float-right"
                style="margin-right: 2mm;">Retornar
            </button>
        </form>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
