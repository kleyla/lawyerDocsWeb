<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\UsersExport;
use App\Exports\ClientesExport;
use App\Exports\ExpedientesExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Cliente;

class ReporteController extends Controller
{
    public function reportes()
    {
        if (Auth::user()->permiso_id == 1 || Auth::user()->permiso_id == 2) {
            $clientes = Cliente::where('estado', true)->get();
            // dd($clientes);
        }
        if(Auth::user()->permiso_id == 3){
            // dd("jojo");
            $idu = Auth::user()->id;
            // dd($idu);
            $clientes = Cliente::where('estado', true)->get();
            // $clientes = DB::select("select Distinct(clientes.id), clientes.*
            // from clientes, cliente_users
            // where clientes.id = cliente_users.cliente_id and
            //     clientes.estado = true and
            //     cliente_users.user_id = $idu");
        }
        return \view('admin.reportes', \compact('clientes'));
    }
    public function usuariosRep(Request $request)
    {
        $inicio = Carbon::parse($request->fecha_ini_user)->toDateTimeString();
        $fin = Carbon::parse($request->fecha_fin_user)->toDateTimeString();
        $fecha = now();
        return Excel::download(new UsersExport($inicio, $fin), "usuarios $fecha.xlsx");
    }
    public function clientesRep(Request $request)
    {
        $inicio = Carbon::parse($request->fecha_ini_cli)->toDateTimeString();
        $fin = Carbon::parse($request->fecha_fin_cli)->toDateTimeString();
        $fecha = now();
        return Excel::download(new ClientesExport($inicio, $fin), "clientes $fecha.xlsx");
    }
    public function expRep(Request $request)
    {
        $cliente = Cliente::where('id', $request->cliente)->first();
        if ($cliente != null) {
            // dd($cliente);
            $fecha = now();
            return Excel::download(new ExpedientesExport($cliente->id), "expediente del cliente $cliente->nombres $cliente->apellidos $fecha.xlsx");
        }
    }
}
