<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AsignarController extends Controller{

    use RegistersUsers;
    /*
    public function __construct(){
        $this->middleware('can:Configuraciones_Usuarios')->only('index');
    }
    */
    // Display a listing of the resource.
    public function index(){
        $users = User::all();
        return view('configuraciones.usuarios', compact('users'));
    }

    //Show the form for creating a new resource.
    public function create(){
        return view('configuraciones.crearUser');
    }

    //Store a newly created resource in storage.
    public function store(Request $request){
        $validacion = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email|max:255',
            'password' => 'required|string|min:5',
        ]);
        
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return $this->index();
        /*return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);*/
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        $user = User::find($id);
        $roles = Role::all();
        return view('configuraciones.usuario_Roles', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $user = User::find($id);
        $user->roles()->sync($request->roles);
        return $this->index();
        //return redirect()->route('asignar.edit',$user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
