@extends('adminlte::page')
@section('title', 'Usuarios')
@section('content_header')
    <h1>Módulo de Usuarios</h1>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/extras.css') }}">
@stop
@section('content')
    <div class="card">
        <div class="card-header">
                <a href="{{ route('asignar.create') }}" class="btn btn-primary float-right">Nuevo Usuario</a>
        </div>
        <div class="card-body">
            @php
                $heads = ['ID', 'Nombre', 'Correo', ['label' => 'Acciones', 'no-export' => true, 'width' => 25]];
               $config = config('datatables.default');
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('asignar.edit', $user) }}"
                                class="btn btn-xs btn-green" 
                                title="Editar">
                                @include('iconoSVG.edit')
                            </a>
                            <form style="display: inline" action="{{ route('asignar.destroy', $user) }}" method="post"
                                class="formEliminar">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-fucsia" title="Eliminar">@include('iconoSVG.delete')</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Estas seguro?",
                    text: "Se va ha eliminar un registro!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, hacerlo!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            })
        })
    </script>
@stop
