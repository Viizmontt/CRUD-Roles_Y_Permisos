@extends('adminlte::page')
@section('title', 'Roles')
@section('content_header')
    <h1>Roles</h1>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/extras.css') }}">
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <x-adminlte-button label="Nuevo Rol" theme="primary" class="float-right" data-toggle="modal" data-target="#m_newRol"/>
        </div>
        <div class="card-body">
            @php
                $heads = ['ID', 'Nombre', ['label' => 'Acciones', 'no-export' => true, 'width' => 25]];
               $config = config('datatables.default');
            @endphp
            
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <button 
                                type="button" class="btn btn-xs btn-green" data-toggle="modal" data-target="#m_editRol{{$role->id}}" 
                                title="Editar">
                                @include('iconoSVG.edit')
                            </button> 

                            <a href="{{ route('roles.edit', $role) }}"
                                class="btn btn-xs btn-info" 
                                title="Asignar Permisos">
                                @include('iconoSVG.rol')
                            </a>
                        
                            <form style="display: inline" action="{{ route('roles.destroy', $role) }}" method="post" class="formEliminar">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-fucsia" title="Eliminar">@include('iconoSVG.delete')</button>

                            </form>
                        </td>
                    </tr>
                    @include('configuraciones.mRol')
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
