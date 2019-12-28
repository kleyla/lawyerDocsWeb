@extends('layouts.admin')
@section('clientes','active')
@section('contenido')


<div class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Editar perfil de Cliente</h5>
          <div class="flash-message">
              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
          
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
              @endforeach
          </div> <!-- end .flash-message -->
        </div>
        <div class="card-body">
          <form method="POST" class="form" action="{{ route('clienteUpdate', $cliente->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6 pr-md-1">
                <div class="form-group">
                  <label>Nombres</label>
                  <input id="nombres" name="nombres" type="text" class="form-control" placeholder="Nombres" value="{{ $cliente->nombres }}">
                </div>
              </div>
              <div class="col-md-6 pl-md-1">
                <div class="form-group">
                  <label>Apellidos</label>
                  <input id="apellidos" name="apellidos" type="text" class="form-control" placeholder="Apellidos" value="{{ $cliente->apellidos }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Direccion</label>
                <input id="direccion" name="direccion" type="text" class="form-control" placeholder="Direccion" value="{{ $cliente->direccion }}">
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Email</label>
                      <input id="email" name="email" type="email" class="form-control" placeholder="{{ $cliente->email }}">
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pr-md-1">
                <div class="form-group">
                  <label>Numero</label>
                  <input id="numero" name="numero" type="text" class="form-control" placeholder="Nuemro" value="{{ $cliente->numero }}">
                </div>
              </div>
              <div class="col-md-4 px-md-1">
                <div class="form-group">
                  <label>CI</label>
                  <input id="ci" name="ci" type="text" class="form-control" placeholder="CI" value="{{ $cliente->ci }}">
                </div>
              </div>
              <div class="col-md-4 pl-md-1">
                <div class="form-group">
                  <label>Genero</label>
                  <input type="number" class="form-control" placeholder="ZIP Code">
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
                @if ($cliente->genero == 'femenino')
                  <img class="avatar" src="{{asset("img/clientes/animewo.png")}}" alt="...">
                @else
                  <img class="avatar" src="{{asset("img/clientes/animeman.png")}}" alt="...">
                @endif
              <h5 class="title">{{ $cliente->nombres }} {{ $cliente->apellidos }}</h5>
              </a>
              <p class="description">
                {{ $cliente->numero }}
              </p>
            </div>
          </p>
          <div class="card-description">
            <h5>Nombres:  {{ $cliente->nombres }}</h5>
            <h5>Apellidos:  {{ $cliente->apellidos }}</h5>
            <h5>CI:  {{ $cliente->ci }}</h5>
            <h5>Numero:  {{ $cliente->numero }}</h5>
            <h5>Direccion:  {{ $cliente->direccion }}</h5>
            <h5>Genero:  {{ $cliente->genero }}</h5>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection