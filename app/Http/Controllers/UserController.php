<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\User;
use App\Permiso;
use App\Expediente;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->permiso_id == 1) {
            $users = DB::table('users')->where('estado', true)->get();
            $permisos = Permiso::all();
        }
        if (Auth::user()->permiso_id == 2) {
            $idu = Auth::user()->id;
            $users = DB::select("select users.*
                from users
                where (users.permiso_id = 3 or
                    users.id = $idu) and
                    users.estado = true");
            // dd($users);
            $permisos = DB::table('permisos')->where('id',3)->get();
        }
        return \view('admin.users.users', compact('users', 'permisos'));
    }

    public function create(Request $request)
    {
        $user = new User;
        $file = $request->file('photo');
        if ($file) {
            $path = public_path() . '/img/users';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $user->photo = $fileName;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->permiso_id = $request->permiso;
        $user->save();
        $request->session()->flash('alert-success', 'Usuario guardado con exito!');
        return \redirect()->route('users');
    }

    public function userVer($idu)
    {
        $user = User::find($idu);
        $expedientes = DB::select("select expedientes.*, clientes.id as idc, clientes.nombres
            from expedientes, expediente_users, clientes
            where  clientes.id = expedientes.cliente_id and
                expediente_users.expediente_id = expedientes.id and
                expediente_users.user_id = $user->id");
        // dd($expedientes);
        return \view('admin.users.userVer', \compact('user','expedientes'));
    }

    public function userEdit($idu)
    {
        // dd($idu);
        $user = User::find($idu);
        $permisos = Permiso::all();
        return \view('admin.users.userEdit', compact('user', 'permisos'));
    }
    public function store(Request $request, $idu)
    {
        $user = User::find($idu);
        $user->nombres = $request->nombres;
        $user->apellidos = $request->apellidos;
        $user->numero = $request->numero;
        $user->ci = $request->ci;
        $user->direccion = $request->direccion;
        $user->save();
        $request->session()->flash('alert-success', 'Usuario actualizado con exito!');
        return \redirect()->route('userEdit', $idu);
    }

    public function miPerfil()
    {
        $user = Auth::user();
        return \view('admin.miPerfil', compact('user'));
    }

    public function destroy(Request $request , $idu)
    {
        $user = User::find($idu);
        $user->estado = false;
        $user->save();
        $request->session()->flash('alert-danger', 'Usuario eliminado con exito!');
        return \redirect()->route('users');
    }

    // APIS
    public function loginApi(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->first();
        //dd($request->email);
        if (is_null($user)) {
            return response()->json();
        } elseif (Hash::check($request->password, $user->password)) {
            return response()->json($user, 200);
        } else {
            return response()->json();
        }
        //return \response()->json($user, 200);
    }
}
