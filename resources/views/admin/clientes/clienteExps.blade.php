@extends('layouts.admin')
@section('clientes','active')
@section('contenido')

<div class="content">
    <div class="row">
        <div class="col-md-9">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Documentos activos </h4>
                    @if ( Auth::user()->permiso_id == 1 || Auth::user()->permiso_id == 2 )
                    <Button class="btn-icon btn-primary alingleft" size="sm" data-toggle="modal"
                        data-target="#expedienteAdd">
                        <i class="tim-icons icon-simple-add"></i>
                    </Button>
                    @endif
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
                                    <th class="text-center">Descripcion</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expsActivos as $expsActivo)
                                <tr>
                                    <td>{{ $expsActivo->id }}</td>
                                    <td class="">{{ $expsActivo->titulo }}</td>
                                    <td class="">{{ $expsActivo->descripcion }}</td>
                                    <td class="text-center">{{ $expsActivo->created_at }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('clienteDocs', $expsActivo->id) }}" title="Ver documentos">
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
            {{-- DOCUMENTOS ARCHIVADOS --}}
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Expedientes archivados </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="expDatatable">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Numero</th>
                                    <th class="text-center">Documento</th>
                                    <th class="text-center">Fecha inicio</th>
                                    <th class="text-center">Fecha fin</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expsArchivados as $expsArchivado)
                                <tr>
                                    <td>{{ $expsArchivado->id }}</td>
                                    <td class="text-center">{{ $expsArchivado->descripcion }}</td>
                                    <td class="text-center">{{ $expsArchivado->created_at }}</td>
                                    <td class="text-center">{{ $expsArchivado->updated_at }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('clienteDocs', $expsArchivado->id) }}" title="Ver documentos">
                                            <Button class="btn-icon btn-info" size="sm">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </Button>
                                        </a>
                                        {{-- <a href="{{ route('clienteEdit', $docsArchivado->id) }}" title="Editar
                                        datos">
                                        <Button class="btn-icon btn-success alingleft" size="sm">
                                            <i class="tim-icons icon-pencil"></i>
                                        </Button>
                                        </a>
                                        <Button class="btn-icon btn-danger" size="sm" data-toggle="modal"
                                            data-target="#clienteDel" title="Eliminar">
                                            <i class="tim-icons icon-paper"></i>
                                        </Button> --}}
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
                                <img class="avatar" src="{{asset("img/clientes/animeman.png")}}" alt="...">
                                <h5 class="title">{{ $cliente->nombres }} {{ $cliente->apellidos }}</h5>
                            </a>
                            <p class="description">
                                {{ $cliente->numero }}
                            </p>
                        </div>
                    </p>
                    <div class="card-description">
                        <h5>Nombres: {{ $cliente->nombres }}</h5>
                        <h5>Apellidos: {{ $cliente->apellidos }}</h5>
                        <h5>CI: {{ $cliente->ci }}</h5>
                        <h5>Numero: {{ $cliente->numero }}</h5>
                        <h5>Direccion: {{ $cliente->direccion }}</h5>
                        <h5>Genero: {{ $cliente->genero }}</h5>
                    </div>
                    <a href="{{route('clienteEdit', $cliente->id)}}">Editar</a>
                </div>

            </div>
        </div>
    </div>
    {{-- DOCUMENTOS ARCHIVADOS --}}
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Expedientes archivados </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Numero</th>
                                    <th class="text-center">Documento</th>
                                    <th class="text-center">Fecha inicio</th>
                                    <th class="text-center">Fecha fin</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($docsArchivados as $docsArchivado)
                                    <tr>
                                        <td>{{ $docsArchivado->id }}</td>
    <td class="text-center">{{ $docsArchivado->descripcion }}</td>
    <td class="text-center">{{ $docsArchivado->created_at }}</td>
    <td class="text-center">{{ $docsArchivado->updated_at }}</td>
    <td class="text-right">
        <a href="{{ route('clienteEdit', $docsArchivado->id) }}" title="Ver documentos">
            <Button class="btn-icon btn-info" size="sm">
                <i class="tim-icons icon-zoom-split"></i>
            </Button>
        </a>
        <a href="{{ route('clienteEdit', $docsArchivado->id) }}" title="Editar datos">
            <Button class="btn-icon btn-success alingleft" size="sm">
                <i class="tim-icons icon-pencil"></i>
            </Button>
        </a>
        <Button class="btn-icon btn-danger" size="sm" data-toggle="modal" data-target="#clienteDel" title="Eliminar">
            <i class="tim-icons icon-trash-simple"></i>
        </Button>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
</div>
</div>
</div>
</div>
</div> --}}
</div>

<div class="modal modal-black show" id="expedienteAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary" id="exampleModalLabel">Nuevo expediente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="POST" action="{{ route('expedienteAdd', $cliente->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="titulo" required>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="primary text">Descripcion del expediente</label>
                        <textarea name="descripcion" id="descripcion" class="form-control"
                            id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <h5 class="text-center text-success" f>Designar pasantes:</h5>
                    <div class="table-responsive">
                        <table class="table tablesorter " id="userDatatable">
                            <thead class=" text-primary">
                                <tr>
                                    <th></th>
                                    <th>Nro</th>
                                    <th>Nombre</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox"
                                                    name="pasantes{{$user->id}}" value="{{ $user->id }}">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->nombres }} {{ $user->apellidos }}</td>
                                    <td>
                                        <div class="photo">
                                            <img src="{{asset("img/users/$user->photo")}}" alt="Profile Photo">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($expsActivos != null)
<div class="modal" id="expArch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Archivar expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="POST" action="{{ route('expedienteArchivar', $expsActivo->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p>Realmente desea archivar este expediente?.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-black show" id="expedienteEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="POST" action="{{ route('expedienteEdit', $expsActivo->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descripcion del expediente</label>
                        <textarea name="descripcion" id="descripcion" class="form-control"
                            id="exampleFormControlTextarea1" rows="3" value="{{$expsActivo->descripcion}}"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@push('custom-scripts')
<script type="text/javascript">
    $(document).ready(function() {
          $().ready(function() {
            var clientesTable = $('#userDatatable').DataTable();
            clientesTable.on('click', '.deluser', function(){
              $tr = $(this).closest('tr');
              if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
              }
              var data = clientesTable.row($tr).data();
              console.log(data);
              $("#userDelModal").modal('show');
              $('#delUserForm').attr('action', '/userDel/'+data[0]);
            });

            var espedientesTable = $('#expDatatable').DataTable();

          });
        });
</script>
@endpush


@endsection
