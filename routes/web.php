<?php

use App\Http\Controllers\AgenciaCooperanteController;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', function () {
    return view('auth/login');
});

Route::resource('/proyectos', ProyectoController::class)->names('proyecto');
Route::put('/eliminar_proyecto/{id}', [ProyectoController::class, 'eliminar_proyecto'])->name('proyectos.eliminar_proyecto');
Route::resource('/roles', RoleController::class)->names('roles');
Route::resource('/permisos', PermisoController::class)->names('permisos');
Route::resource('/usuarios', PermisoController::class)->names('asignar');
Route::put('/roles/{role}/Permisos', [RoleController::class, 'updatePermisos'])->name('roles.updatePermisos');
Route::resource('/usuarios', AsignarController::class)->names('asignar');
/*
Route::get('/verArchivo/{nombreArchivo}', function ($nombreArchivo) {
    return response()->file(storage_path('app/public/files/' . $nombreArchivo));
})->name('verArchivo');
*/
Route::resource('/agencia', AgenciaCooperanteController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');