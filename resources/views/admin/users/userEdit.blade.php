@extends('layouts.admin')
@section('users','active')
@section('contenido')

<div class="content">
    <div class="row">
        <div class="col-md-8">
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
                    <form method="POST" class="form" action="{{ route('userUpdate', $user->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 px-md-1">
                                <div class="form-group">
                                    <label>Nick</label>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Nick"
                                        value="{{ $user->name}}">
                                </div>
                            </div>
                            <div class="col-md-6 pl-md-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input id="email" name="email" type="email" class="form-control"
                                        placeholder="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-md-1">
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input id="nombres" name="nombres" type="text" class="form-control"
                                        placeholder="Nombres" value="{{ $user->nombres }}">
                                </div>
                            </div>
                            <div class="col-md-6 pl-md-1">
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input id="apellidos" name="apellidos" type="text" class="form-control"
                                        placeholder="Apellidos" value="{{ $user->apellidos }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Direccion</label>
                                    <input id="direccion" name="direccion" type="text" class="form-control"
                                        placeholder="Direccion" value="{{ $user->direccion }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-md-1">
                                <div class="form-group">
                                    <label>Numero</label>
                                    <input id="numero" name="numero" type="text" class="form-control"
                                        placeholder="Nuemro" value="{{ $user->numero }}">
                                </div>
                            </div>
                            <div class="col-md-4 px-md-1">
                                <div class="form-group">
                                    <label>CI</label>
                                    <input id="ci" name="ci" type="text" class="form-control" placeholder="CI"
                                        value="{{ $user->ci }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-md-4">
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
