<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ClienteUser;
use Illuminate\Http\Request;
use App\Expediente;
use DB;
use Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->permiso_id == 1) {
            $clientes = DB::table('clientes')->where('estado', true)->get();
        }
        if (Auth::user()->permiso_id == 2) {
            $idu = Auth::user()->id;
            // $clientes = DB::select("select clientes.*
            //     from clientes, expedientes, expediente_users
            //     where clientes.id = expedientes.cliente_id and
            //         expedientes.id =  expediente_users.expediente_id and
            //         expediente_users.user_id = $idu");
            $clientes = DB::select("select Distinct(clientes.id), clientes.*
                from clientes, cliente_users
                where clientes.id = cliente_users.cliente_id and
                    clientes.estado = true and
                    cliente_users.user_id = $idu");

            // dd($clientes);
        }
        // dd($clientes);
        return \view('admin.clientes.clientes', \compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cliente = new Cliente;
        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->ci = $request->ci;
        $cliente->numero = $request->numero;
        $cliente->direccion = $request->direccion;
        $cliente->email = $request->email;
        $cliente->save();
        if (Auth::user()->permiso_id != 1) {
            $user = Auth::user();
            $clienteUser = new ClienteUser();
            $clienteUser->cliente_id = $cliente->id;
            $clienteUser->user_id = $user->id;
            $clienteUser->save();
        }
        $request->session()->flash('alert-success', 'Cliente guardado con exito!');
        return \redirect()->route('clientes');
    }

    public function clienteEdit($idc)
    {
        $cliente = Cliente::find($idc);
        return \view('admin.clientes.clienteEdit', \compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente;
        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->ci = $request->ci;
        $cliente->numero = $request->numero;
        $cliente->direccion = $request->direccion;
        $cliente->email = $request->email;
        $cliente->save();
        $request->session()->flash('alert-success', 'Cliente actualizado con exito!');
        return \redirect()->route('clientes');
    }

    public function clienteExps($idc)
    {
        $cliente = Cliente::find($idc);
        $expsActivos = DB::select("select *
            from expedientes
            where cliente_id = $idc and estado = true");
        $expsArchivados = DB::select("select *
            from expedientes
            where cliente_id = $idc and estado = false");
        $users = DB::table('users')->where('estado', true)
            ->where('permiso_id', 3)->get();
        return view('admin.clientes.clienteExps', \compact('cliente', 'expsActivos', 'expsArchivados', 'users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $idu)
    {
        $cliente = Cliente::find($idu);
        $cliente->estado = false;
        $cliente->save();
        $request->session()->flash('alert-success', 'Cliente eliminado con exito!');
        return \redirect()->route('clientes');
    }

    public function clientesAsistente()
    {
        $idu = Auth::user()->id;
        // dd($idu);
        $clientes = DB::select("select Distinct(clientes.id), clientes.*
            from clientes, expedientes, expediente_users
            where expediente_users.user_id = $idu and
            expedientes.id = expediente_users.expediente_id and
            expedientes.cliente_id = clientes.id and
            expediente_users.estado = true and
            expedientes.estado = true");
        // $cliente = DB::select("select * from expediente_users");
        // dd($clientes);
        return \view('admin.clientes.clientesAsistente', compact('clientes'));
    }

    //  API
    public function clientesApi()
    {
        $clientes = DB::select("select *
            from clientes
            where estado = true");
        // dd($clientes);
        return response()->json($clientes, 200);
    }
    public function clientesUserApi($idu)
    {
        $user = DB::table('users')->where('tokenFirebase', $idu)->first();
        // dd($user);
        $clientes = DB::select("select DISTINCT(clientes.id), clientes.*
            from clientes, expedientes, expediente_users
            where expediente_users.user_id = $user->id and
            expedientes.id = expediente_users.expediente_id and
            expedientes.cliente_id = clientes.id and
            expediente_users.estado = true and
            expedientes.estado = true");
        // $clientes = DB::select("select *
        //     from clientes
        //     where estado = true");
        // dd($clientes);
        return response()->json($clientes, 200);
    }
    public function clienteApi($idc)
    {
        $cliente = DB::table('clientes')->where('id', $idc)->first();
        // dd($cliente);
        return response()->json($cliente, 200);
    }
}
