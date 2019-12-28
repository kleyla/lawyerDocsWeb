<?php

namespace App\Http\Controllers;

use App\Permiso;
use Illuminate\Http\Request;
use DB;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = DB::table('permisos')->where('estado', true)->get();
        return \view('admin.permisos.permisos', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permiso = new Permiso();
        $permiso->titulo = $request->titulo;
        $permiso->save();
        $request->session()->flash('alert-success', 'Permiso guardado con exito!');
        return \redirect()->route('permisos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function show(Permiso $permiso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function edit(Permiso $permiso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permiso $permiso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $idp)
    {
        $permiso = Permiso::find($idp);
        $permiso->estado = false;
        $permiso->save();
        $request->session()->flash('alert-success', 'Permiso eliminado con exito!');
        return \redirect()->route('permisos');
    }
}
