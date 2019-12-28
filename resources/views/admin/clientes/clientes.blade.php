@extends('layouts.admin')
@section('clientes','active')
@section('contenido')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Clientes </h4>
                    <Button class="btn-icon btn-primary alingleft" size="sm" data-toggle="modal"
                        data-target="#clienteAdd">
                        <i class="tim-icons icon-simple-add"></i>
                    </Button>
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
                        <table class="table tablesorter" id="clienteDatatable">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>CI</th>
                                    <th>Numero</th>
                                    <th>Direccion</th>
                                    {{-- <th>Email</th> --}}
                                    <th class="text-center">Fecha</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->nombres }}</td>
                                    <td>{{ $cliente->apellidos }}</td>
                                    <td>{{ $cliente->ci }}</td>
                                    <td>{{ $cliente->numero }}</td>
                                    <td>{{ $cliente->direccion }}</td>
                                    {{-- <td>{{ $cliente->email }}</td> --}}
                                    <td class="text-center">{{ $cliente->created_at }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('clienteExps', $cliente->id) }}" title="Ver expedientes">
                                            <Button class="btn-icon btn-info" size="sm">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </Button>
                                        </a>
                                        <a href="{{ route('clienteEdit', $cliente->id) }}" title="Editar datos">
                                            <Button class="btn-icon btn-success alingleft" size="sm">
                                                <i class="tim-icons icon-pencil"></i>
                                            </Button>
                                        </a>
                                        <Button type="button" rel="tooltip" class="btn-icon btn-danger delcli" size="sm"
                                            data-toggle="modal" data-target="#delClienteModal" title="Eliminar">
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

    </div>
</div>

<div class="modal modal-black show" id="clienteAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="POST" action="{{ route('clienteAdd') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 pr-md-1">
                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres"
                                required>
                        </div>
                        <div class="col-md-6 pr-md-1">
                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                                placeholder="Apellidos" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4 pr-md-1">
                            <input type="number" class="form-control" id="numero" name="numero" placeholder="Numero"
                                required>
                        </div>
                        <div class="col-md-4 pr-md-1">
                            <input type="number" class="form-control" id="ci" name="ci" placeholder="CI" required>
                        </div>
                        <div class="col-md-4 pr-md-1">
                            <div class="form-group">
                                <label class="small">Seleccione su genero</label>
                                {{-- <h5 class="small">Seleccione su genero</h5> --}}
                                <select name="genero" class="form-control" data-style="btn btn-link"
                                    id="exampleFormControlSelect1">
                                    <option name="genero" value="femenino">Femenino</option>
                                    <option name="genero" value="masculino">Masculino</option>
                                    <option name="genero" value="otro">Otro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-md-1">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="col-md-4 pr-md-1">
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                placeholder="Direccion" required>
                        </div>
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

@if ( $clientes != null )
<div class="modal fade" id="delClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar cliente </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form" method="POST" action="/clienteDel" enctype="multipart/form-data" id="delClienteForm">
                @csrf
                <div class="modal-body">
                    <p>Realmente desea eliminar este cliente?.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Aceptar</button>
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

            var clientesTable = $('#clienteDatatable').DataTable();
            clientesTable.on('click', '.delcli', function(){
              $tr = $(this).closest('tr');
              if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
              }

              var data = clientesTable.row($tr).data();
              console.log(data);
              $("#delClienteModal").modal('show');
            //   $('#delClienteModal').modal();
              $('#delClienteForm').attr('action', '/clienteDel/'+data[0]);
            });


          });
        });

</script>
@endpush

@endsection
