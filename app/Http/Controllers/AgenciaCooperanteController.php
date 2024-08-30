<?php

namespace App\Http\Controllers;

use App\Models\AgenciaCooperante;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AgenciaCooperanteController extends Controller{
    
    public function index(){
        $agencias = AgenciaCooperante::all();
        return view('configuraciones.miscelaneas.agencia.agencia' , compact('agencias'));
    }
    
    public function create(){}

    public function store(Request $request){
        $agenciaExistente = AgenciaCooperante::where('codigo', $request->input('codigo'))->orWhere('nombre', $request->input('nombre'))->first();
        if ($agenciaExistente) {
            Session::flash('error', 'Ya existe una Agencia Cooperante con ese código o nombre.');
        }else {
            $agencia = new AgenciaCooperante();
            $agencia->codigo = $request->input('codigo');
            $agencia->nombre = $request->input('name');
            $agencia->detalle = $request->input('detalle');
            if ($agencia->save()) {
                Session::flash('C', 'Se creó la País Cooperante con éxito.');
            }else {
                Session::flash('error', 'Error al agregar los datos, verifique que los campos estén correctos.');
            }
        }
        return redirect()->route('agencia.index');
    }

    public function show(){}

    public function edit(String $id){
        $agencia = AgenciaCooperante::find($id);
        return view('configuraciones.miscelaneas.rangoEdad.edad' , compact('rango_edad'));
    }

    public function update(Request $request){
        $id=$request->input('id');
        $agenciaExistente = AgenciaCooperante::where('codigo', $request->input('codigo'))->where('nombre', $request->input('nombre'))->where('id', '!=', $id)->first();
        if ($agenciaExistente) {
            Session::flash('error', 'Ya existe una Agencia Cooperante con ese código o nombre.');
        }else {
            $agencia = AgenciaCooperante::find($id);
            $agencia->codigo = $request->input('codigo');
            $agencia->nombre = $request->input('name');
            $agencia->detalle = $request->input('detalle');
            if ($agencia->save()) {
                Session::flash('A', 'Se actualizó el País Cooperante con éxito.');
            }else {
                Session::flash('error', 'Error al agregar los datos, verifique que los campos estén correctos.');
            }
        }
        return redirect()->route('agencia.index'); 
    }

    public function destroy(String $id){
        $agenciaExistente = Proyecto::where('id', 11)->first();
        if ($agenciaExistente) {
            Session::flash('error', 'No se puede eliminar debido a que hay proyectos con esa Agencia Cooperante.');
        }else {
            $agencia = AgenciaCooperante::findOrFail($id);
            $agencia->delete();
        }
        return redirect()->route('agencia.index'); 
    }

}
