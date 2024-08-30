@extends('adminlte::page')

@section('title', 'Usuarios y Roles')

@section('content_header')
<div class="text-center">
    {{ $user->name }}
</div>
@stop

@section('content')

    <div class="modal-content border-secondary">

        <div class="modal-body d-flex justify-content-center align-items-center">

            {!! Form::model($user, ['route' => ['asignar.update', $user], 'method' => 'put']) !!}
            @foreach ($roles as $role)
                <div>
                    <label for="">
                        {!! Form::checkbox('roles[]', $role->id, $user->hasAnyRole($role->id) ?: false, [
                            'class' => 'mr-1',
                        ]) !!}
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
            {!! Form::button('Cancelar', ['class' => 'btn btn-danger mt-3', 'onclick' => 'window.location.href="' . route('asignar.index') . '"']) !!}
            {!! Form::submit('Asignar Roles', ['class' => 'btn btn-primary mt-3']) !!}
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
