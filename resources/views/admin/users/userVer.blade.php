@extends('layouts.admin')
@section('users','active')
@section('contenido')

<div class="content">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Editar perfil</h5>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close"
                                data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        @endforeach
                    </div> <!-- end .flash-message -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="expDatatable">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Numero</th>
                                    <th class="text-center">Titulo</th>
                                    <th class="text-center">Cliente</th>

                                    <th class="text-center">Fecha</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expedientes as $expediente)
                                <tr>
                                    <td>{{ $expediente->id }}</td>
                                    <td class=""><a href="{{route('clienteDocs', $expediente->id)}}">{{ $expediente->titulo }}</a></td>
                                    <td class=""><a href="{{route('clienteExps', $expediente->idc)}}">{{ $expediente->nombres }}</a></td>

                                    <td class="text-center"><small>{{ $expediente->created_at }}</small></td>
                                    <td class="text-right">
                                        <a href="{{ route('clienteDocs', $expediente->id) }}" title="Ver documentos">
                                            <Button class="btn-icon btn-info" size="sm">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </Button>
                                        </a>
                                        @if (Auth::user()->permiso_id == 1 || Auth::user()->permiso_id == 2 )
                                        <Button class="btn-icon btn-success alingleft" size="sm" data-toggle="modal"
                                            data-target="#expedienteEdit" title="Editar">
                                            <i class="tim-icons icon-pencil"></i>
                                        </Button>

                                        <Button class="btn-icon btn-danger" size="sm" data-toggle="modal"
                                            data-target="#expArch" title="Archivar">
                                            <i class="tim-icons icon-paper"></i>
                                        </Button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="javascript:void(0)">
                                <img class="avatar" src="{{asset("img/users/$user->photo")}}" alt="...">
                                <h5 class="title">{{ $user->name }}</h5>
                            </a>
                            <p class="description">
                                {{ $user->email }}
                            </p>
                        </div>
                    </p>
                    <div class="card-description">
                        <h5>Nombres: {{ $user->nombres }}</h5>
                        <h5>Apellidos: {{ $user->apellidos }}</h5>
                        <h5>CI: {{ $user->ci }}</h5>
                        <h5>Numero: {{ $user->numero }}</h5>
                        <h5>Direccion: {{ $user->direccion }}</h5>
                        <h5>Genero: {{ $user->genero }}</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
