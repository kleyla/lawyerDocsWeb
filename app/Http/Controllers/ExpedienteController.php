<?php

namespace App\Http\Controllers;

use App\Expediente;
use Illuminate\Http\Request;
use App\Documento;
use DB;
use App\Cliente;
use App\ExpedienteUser;
use Auth;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $idc)
    {
        $expediente = new Expediente();
        $expediente->titulo = $request->titulo;
        $expediente->descripcion = $request->descripcion;
        $expediente->cliente_id = $idc;
        $expediente->save();

        $users = DB::table('users')->where('estado', true)
            ->where('permiso_id', 3)->get();
        // dd($request);
        if (Auth::user()->permiso_id == 2) {
            $expUser = new ExpedienteUser();
            $expUser->expediente_id = $expediente->id;
            $expUser->user_id = Auth::user()->id;
            $expUser->save();
        }
        foreach ($users as $user) {
            if ($request->input("pasantes$user->id") != null) {
                // dd($user->id);
                $expUser = new ExpedienteUser();
                $expUser->expediente_id = $expediente->id;
                $expUser->user_id = $user->id;
                $expUser->save();
            }
        }
        $request->session()->flash('alert-success', 'Exxpediente creado con exito!');
        return \redirect()->route('clienteExps', $idc);
    }

    public function expUsersAdd(Request $request, $ide)
    {
        $expediente = Expediente::find($ide);
        $users = DB::table('users')->where('estado', true)
            ->where('permiso_id', 3)->get();
        // dd($request);
        foreach ($users as $user) {
            if ($request->input("pasantes$user->id") != null) {
                // dd($user->id);
                $expUser = new ExpedienteUser();
                $expUser->expediente_id = $expediente->id;
                $expUser->user_id = $user->id;
                $expUser->save();
            }
        }
        $request->session()->flash('alert-success', 'Usuario agregado al expediente con exito!');
        return \redirect()->route('clienteDocs', $ide);
    }

    public function clienteDocs($ide)
    {
        $expediente = Expediente::find($ide);
        $cliente = Cliente::find($expediente->cliente_id);
        $documentos = DB::select("select *
            from documentos
            where expediente_id = $ide");
        $users = DB::select("select users.*, expediente_users.id as cod
            from users, expediente_users
            where users.id = expediente_users.user_id and
            expediente_users.expediente_id = $ide and
            expediente_users.estado = true");
        $usersNew = DB::select("select DISTINCT (users.id), users.*
            from users, expediente_users
            where users.estado =true and
                users.permiso_id = 3 and
                expediente_users.user_id != users.id");
        // dd($usersNew);
        return \view('admin.clientes.clienteDocs', \compact('expediente', 'documentos', 'cliente', 'users', 'usersNew'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $ide)
    {
        $expediente = Expediente::find($ide);
        $expediente->descripcion = $request->descripcion;
        $expediente->save();
        $request->session()->flash('alert-success', 'Expediente actualizado con exito!');
        return \redirect()->route('clienteExps', $expediente->cliente_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function show(Expediente $expediente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function edit(Expediente $expediente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expediente $expediente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $ide)
    {
        // ARCHIVA EL EXPEDIENTE
        $expediente = Expediente::find($ide);
        $expediente->estado = false;
        $expediente->save();
        $request->session()->flash('alert-success', 'Expediente archivado con exito!');
        return \redirect()->route('clienteExps', $expediente->cliente_id);
    }

    public function userDelExp(Request $request, $ideu)
    {
        $expUser = ExpedienteUser::find($ideu);
        $expUser->estado = false;
        $expUser->save();
        $request->session()->flash('alert-success', 'Usuario eliminado del caso con exito!');
        return \redirect()->route('clienteDocs', $expUser->expediente_id);
    }

    //APIS
    public function clienteExpedientes($idc)
    {
        $expedientes = DB::table('expedientes')->where('cliente_id', $idc)
            ->where('estado', true)->get();
        return response()->json($expedientes, 200);
    }

    public function expedienteDocumentos($ide)
    {
        $documentos = DB::table('documentos')->where('expediente_id', $ide)
            ->where('estado', true)->get();
        return response()->json($documentos, 200);
    }
}
