<?php

namespace App\Http\Controllers;

use App\Documento;
use Illuminate\Http\Request;
use App\ExpedienteUser;
use App\User;


class DocumentoController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documento $documento)
    {
        //
    }

    // APIS

    public function newDoc ( Request $request )
    {
        $userId = $request->user_id;
        $expedienteId = $request->expediente_id;
        $expediente = Expediente::find($expedienteId);
        $user = User::find($userId);
        $documento = new Documento();
        $file = $request->file('doc');
        if($file){
            $path = public_path() . '/img/docs';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $documento->doc = $fileName;
        }
        if( $expediente!= null && $user != null){
            $documento->user_id = $user->id;
            $documento->expediente_id = $expediente->id;
            $documento->save();
            return response()->json();
        }
    }
}
