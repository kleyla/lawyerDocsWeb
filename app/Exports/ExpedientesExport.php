<?php

namespace App\Exports;

use App\Expediente;
use App\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpedientesExport implements FromCollection, WithHeadings
{
    protected $idc;

    public function __construct($idc)
    {
        $this->idc = $idc;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // dd($this->idc);
        $cliente = Cliente::find($this->idc);
        // dd($cliente);
        if ($cliente != null) {
            $expedientes = Expediente::where('estado', true)->where('cliente_id', $cliente->id)->get();
            // dd($expedientes);
            $cliente->expedientes =$expedientes;
            foreach ( $expedientes as $expediente){
                $expedientes->cliente = $cliente->nombre;
            }
            // dd($cliente);
            return  $expedientes;
        } else {
            // return Expediente::all();
        }
    }
    public function headings(): array
    {
        return [
            'Id',
            'Titulo',
            'Descripcion',
            'id_cliente',
            'Estado',
            'fecha de creacion',
        ];
    }
}
