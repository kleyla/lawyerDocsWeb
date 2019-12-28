<?php

namespace App\Exports;

use App\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ClientesExport implements FromCollection, WithHeadings
{
    protected $fecha_ini;
    protected $fecha_fin;

    public function __construct($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->fecha_ini == $this->fecha_fin) {
            $clientes = Cliente::where('estado', true)->get();
            return $clientes;
        } else {
            $clientes = Cliente::where('estado', true)->whereBetween('created_at', [$this->fecha_ini, $this->fecha_fin])->get();
            return $clientes;
        }
        // return Cliente::all();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Nombres',
            'Apellidos',
            'email',
            'ci',
            'Numero',
            'Genero',
            'Direccion',
            'Estado',
            'fecha de creacion',
        ];
    }
}
