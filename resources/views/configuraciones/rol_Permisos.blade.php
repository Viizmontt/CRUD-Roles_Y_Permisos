@extends('adminlte::page')

@section('title', 'Roles y Accesos')

@section('content_header')
<div class="text-center">
    {{ $role->name }}
</div>
@stop

@section('content')

    <div class="modal-content border-secondary">

        <div class="modal-body d-flex justify-content-center align-items-center">

            {!! Form::model($role, ['route' => ['roles.update', $role], 'method' => 'put']) !!}
            @foreach ($permisos as $permiso)
                <div>
                    <label for="">
                        {!! Form::checkbox('permisos[]', $permiso->id, $role->hasPermissionTo($permiso->id) ?: false, [
                            'class' => 'mr-1',
                        ]) !!}
                        {{ $permiso->name }}
                    </label>
                </div>
            @endforeach
            {!! Form::button('Cancelar', ['class' => 'btn btn-danger mt-3', 'onclick' => 'window.location.href="' . route('roles.index') . '"']) !!}
            {!! Form::submit('Asignar Permisos', ['class' => 'btn btn-primary mt-3']) !!}
            {!! Form::close() !!}
            
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
