@extends('adminlte::page')
@section('title', 'Permisos')
@section('content_header')
    <h1>Permisos</h1>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/extras.css') }}">
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <x-adminlte-button label="Nuevo Permiso" theme="primary" class="float-right" data-toggle="modal" data-target="#m_newPermiso"/>
        </div>
        <div class="card-body">
            @php
                $heads = ['Id', 'Nombre', ['label' => 'Acciones', 'no-export' => true, 'width' => 25]];
               $config = config('datatables.default');
            @endphp

            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($permisos as $permiso)
                    <tr>
                        <td>{{ $permiso->id }}</td>
                        <td>{{ $permiso->name }}</td>
                        <td>
                            <button 
                                type="button" class="btn btn-xs btn-green" data-toggle="modal" data-target="#m_editPermiso{{$permiso->id}}">
                                @include('iconoSVG.edit')
                            </a>
                            </button>

                            <form style="display: inline" action="{{ route('permisos.destroy', $permiso) }}" method="post"
                                class="formEliminar">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-fucsia" title="Eliminar">@include('iconoSVG.delete')</button>
                            </form>
                        </td>
                    </tr>
                    @include('configuraciones.mPermisos')
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>


    <div class="modal fade" id="m_newPermiso" name="m_newPermiso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Permiso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('permisos.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Nombre Permiso: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nombre_permiso" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
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