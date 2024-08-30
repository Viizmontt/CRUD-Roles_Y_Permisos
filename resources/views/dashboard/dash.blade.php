@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/extras.css') }}">
@stop
@section('content')

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">¡Bienvenidas/os!</h2>
                    </div>
                    <div class="card-body">
                        <p class="lead text-center">Al Módulo del Dashboard</p>
                    </div>
                </div>
            </div>
        </div>
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
