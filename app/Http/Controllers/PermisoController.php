<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller{
    
    public function index(){
        $permisos = Permission::all();
        return view('configuraciones.permisos', compact('permisos'));
    }
    
    public function create(){
        //
    }

    public function store(Request $request){
        $permisos = Permission::create(['name' => $request->input('nombre_permiso')]);
        return back();
    }

    public function show(string $id){
        //
    }

    public function edit(string $id){
        $permiso = Permission::find($id);
        return back()->with('mensaje', 'permiso');
    }

    public function update(Request $request, string $id){
        $hoy = getdate();
        $permiso = Permission::find($id);
        $permiso->name = $request->input('nombre_permiso_edit');
        $permiso->updated_at = $request->input($hoy);
        $permiso->update();
        return redirect()->back();
    }

    public function destroy(string $id){
        $permission = Permission::find($id);
        $permission->delete();
        return back();
    }
}
