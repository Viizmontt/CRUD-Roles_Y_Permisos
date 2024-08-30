<?php

namespace App\Http\Controllers; 

use App\Models\Proyecto;
use App\Models\AgenciaCooperante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProyectoController extends Controller{
    public function __construct(){
        $this->middleware('can:Proyectos')->only('index');
    }
    public function index(){
        $proyectos = Proyecto::join('agencia_cooperantes', 'proyectos.id_agencia', '=', 'agencia_cooperantes.id')->select('proyectos.*', 'agencia_cooperantes.nombre as agencia')
        ->where('proyectos.status', 1)->get();

        $fecha_actual = date("Y-m-d");
        foreach ($proyectos as $proyecto) {
            if ($proyecto->fecha_inicio > $fecha_actual) {
                $proyecto->estado = "Planificado";
                $proyecto->estado_css = "bg-warning";
            } elseif ($proyecto->fecha_finalizacion < $fecha_actual) {
                $proyecto->estado = "Retrasado";
                $proyecto->estado_css = "bg-danger";
            } elseif ($fecha_actual >= $proyecto->fecha_inicio && $fecha_actual <= $proyecto->fecha_finalizacion) {
                $proyecto->estado = "En Proceso";
                $proyecto->estado_css = "bg-info";
            }
            if (!empty($proyecto->prorroga_at)) {
                $proyecto->estado = "Prorrogado";
                $proyecto->estado_css = "bg-fucsia";
                $proyecto->fecha_finalizacion = $proyecto->prorroga_at;
            }
        }
        return view('proyecto.proyectos' , compact('proyectos'));
    }
    
    public function create(){ 
        $agencias = AgenciaCooperante::all();
        return view('proyecto.crearProyecto', compact('agencias'));
    }

    public function store(Request $request){
        $proyectoExistente = Proyecto::where('nombre', $request->input('nombre'))->first();
        if ($proyectoExistente) {
            Session::flash('error', 'Ya existe un proyecto con ese nombre.');
        }else {
            $agencia_id = $request->input('agencia');
            $fecha_inicial = $request->input('fechaI');
            $fecha = new \DateTime($fecha_inicial);
            $fecha_formateada = $fecha->format('Y/m/d');
            $agencia = AgenciaCooperante::findOrFail($agencia_id);
            $codigo = $agencia->codigo . '-' . $fecha_formateada;
            $date = new \DateTime($fecha_inicial);
            $duracion_meses = $request->input('meses');
            $date->modify("+{$duracion_meses} months");
            $fecha = $request->input('fechaF');
            if (empty($fecha)) {
                $fecha_finalizacion = $date->format('Y-m-d');
            } else {
                $fecha_finalizacion = $fecha;
            }
            $proyecto = new Proyecto();
            $proyecto->id_agencia = $agencia_id;
            $proyecto->codigo = $codigo;
            $proyecto->nombre = $request->input('nombre');
            $proyecto->objetivo_general = $request->input('objetivo');
            $proyecto->descripcion = $request->input('descripcion');
            $proyecto->fecha_inicio = $fecha_inicial;
            $proyecto->meses = $duracion_meses;
            $proyecto->fecha_finalizacion = $fecha_finalizacion;
            $proyecto->status = 1; 
            if ($proyecto->save()) {
                Session::flash('C', 'Se creó el proyecto con éxito.');
            }else{
                Session::flash('error', 'Error al agregar los datos, verifique que los campos estén correctos.');
            }
        }
        return redirect()->route('proyecto.index');
    }
    
    public function edit(string $id){
        $proyecto = Proyecto::find($id);
        $agencias = AgenciaCooperante::all();
        $fechaInicio = new \DateTime($proyecto->fecha_inicio);
        $fechaFinalizacion = new \DateTime($proyecto->fecha_finalizacion);
        $fechaFinalizacion->modify('first day of this month');
        $interval = $fechaInicio->diff($fechaFinalizacion);
        $meses = ($interval->y * 12) + $interval->m;
        if ($fechaInicio->format('d') > $fechaFinalizacion->format('d')) {
            $meses++;
        }
        return view('proyecto.editarProyecto', compact('proyecto', 'agencias' ,'meses'));

    }

    public function show(string $id){
        $proyecto = Proyecto::select('proyectos.*', 
        'agencia_cooperantes.codigo as codigoAgencia', 
        'agencia_cooperantes.nombre as nombreAgencia')
        ->join('agencia_cooperantes', 'proyectos.id_agencia', '=', 'agencia_cooperantes.id')
        ->where('proyectos.id', $id)
        ->first();
        return view('proyecto.showProyecto', compact('proyecto'));
    }

    public function update(Request $request, $id){
        $prorrogaEliminada = $request->has('check');
        $proyectoExistente = Proyecto::where('nombre', $request->input('nombre'))->where('id', '!=', $id)->first();
        if ($proyectoExistente) {
            Session::flash('error', 'Ya existe un proyecto con ese nombre.');
        }else{
            $agencia_id = $request->input('agencia_id');
            $fecha_inicial = $request->input('fechaI');
            $fecha = new \DateTime($fecha_inicial);
            $fecha_formateada = $fecha->format('Y/m/d');
            $agencia = AgenciaCooperante::findOrFail($agencia_id);
            $codigo = $agencia->codigo . '-' . $fecha_formateada;
            $date = new \DateTime($fecha_inicial);
            $duracion_meses = $request->input('meses');
            $fecha = $request->input('fechaF');
            if (empty($fecha)) {
                $date->modify("+{$duracion_meses} months");
                $fecha_finalizacion = $date->format('Y-m-d');
            } else {
                $fecha_finalizacion = $fecha;
            }
            $prorroga_at = $request->input('fechaP');
            $proyecto = Proyecto::find($id);
            $proyecto->id_agencia = $agencia_id;
            $proyecto->codigo = $codigo;
            $proyecto->nombre = $request->input('nombre');
            $proyecto->objetivo_general = $request->input('objetivo');
            $proyecto->descripcion = $request->input('descripcion');
            $proyecto->fecha_inicio = $fecha_inicial;
            $proyecto->meses = $duracion_meses;
            $proyecto->fecha_finalizacion = $fecha_finalizacion;
            $proyecto->prorroga_at = $prorroga_at;
            if ($proyecto->update()) {
                if (!empty($prorrogaEliminada)) {
                    Proyecto::where('id', $id)->update(['fecha_finalizacion' => $fecha_finalizacion, 'meses' => $duracion_meses, 'prorroga_at' => null]);
                }
                Session::flash('A', 'Se actualizó el proyecto con éxito.');
            }else {
                Session::flash('error', 'Error al modificar los datos, verifique que los campos estén correctos.');
            }
        }
        return redirect()->route('proyecto.index');
    }

    public function eliminar_proyecto(String $id){
        Proyecto::where('id', $id)->update(['status' => 0]);
        return back();
    }

}