<?php

namespace App\Exports;

use App\User;
use App\Permiso;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
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
            $users = User::where('estado', true)->get();
            foreach ($users as $user) {
                $permiso = Permiso::where('id', $user->permiso_id)->first();
                // dd($permiso);
                $user->permiso = $permiso->titulo;
            }
            return $users;
        } else {
            $users = User::where('estado', true)->whereBetween('created_at', [$this->fecha_ini, $this->fecha_fin])->get();
            foreach ($users as $user) {
                $permiso = Permiso::where('id', $user->permiso_id)->first();
                $user->permiso = $permiso->titulo;
            }
            return $users;
        }
        // return User::all();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Nick',
            'Email',
            'Nombres',
            'Apellidos',
            'Foto',
            'Numero',
            'Direccion',
            'ci',
            'Genero',
            'token fire',
            'verificar email',
            'Estado',
            'token',
            'fecha de creacion',
            'id_permiso',
            'Permiso',
        ];
    }
}
