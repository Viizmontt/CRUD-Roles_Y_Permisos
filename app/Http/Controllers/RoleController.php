<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    class RoleController extends Controller{
        /*
        public function __construct(){
            $this->middleware('can:Configuraciones_Roles')->only('index');
        }
        */
        public function index(){
            $roles = Role::all();
            return view('configuraciones.roles', compact('roles'));
        }

        public function create(){
            //
        }

        public function store(Request $request){
            $role = Role::create(['name' => $request->input('nombre_rol')]);
            return back();
        }

        public function edit(Role $role){
            $permisos = Permission::all();
            return view('configuraciones.rol_Permisos', compact('role', 'permisos'));
        }

        public function show(string $id){
            //
        }

        public function update(Request $request, Role $role){
            $role->permissions()->sync($request->permisos);
            return $this->index();
        }

        public function destroy(string $id){
            $role = Role::find($id);
            $role->delete();
            return back();
        }

        // Nuevo método agregado
        public function rolPermisos(Request $request, string $id){
            $hoy = getdate();
            $role = Role::find($id);
            $role->name = $request->input('nombre_rol_edit');
            $role->updated_at = $request->input($hoy);
            $role->update();
            return redirect()->back();
        }

        public function updatePermisos(Request $request, string $id){
            $hoy = getdate();
            $role = Role::find($id);
            $role->name = $request->input('nombre_rol_edit');
            $role->updated_at = $request->input($hoy);
            $role->update();
            return redirect()->back();
        }
    }
