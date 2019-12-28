@extends('layouts.admin')
@section('permisos','active')
@section('contenido')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Permisos   </h4>
                    <Button class="btn-icon btn-primary alingleft"  size="sm" data-toggle="modal" data-target="#permisoAdd">
                        <i class="tim-icons icon-simple-add"></i>
                    </Button>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                    
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div> <!-- end .flash-message -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="permisoDatatable">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Nro</th>
                                    <th>Titulo</th>
                                    <th class="text-center">Fecha</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permisos as $permiso)
                                    <tr>
                                        <td>{{ $permiso->id }}</td>
                                        <td>{{ $permiso->titulo }}</td>
                                        <td class="text-center">{{ $permiso->created_at }}</td>
                                        <td class="text-right">
                                            <Button class="btn-icon btn-info"  size="sm">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </Button>
                                            <a href="{{ route('userEdit', $permiso->id) }}" title="Editar">
                                                <Button class="btn-icon btn-success alingleft"  size="sm">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </Button>
                                            </a>
                                            <Button class="btn-icon btn-danger delPermiso"  size="sm" data-toggle="modal" data-target="#permisoDelModal" title="Eliminar">
                                                <i class="tim-icons icon-trash-simple" ></i>
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

    <div class="modal modal-black show" id="permisoAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Permiso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form" method="POST" action="{{ route('permisoAdd') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control" id="titulo" name ="titulo" placeholder="titulo" required>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>    
                </form>
            </div>
        </div>
    </div>

    <div class="modal modal-black show" id="modalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form" method="POST" action="{{ route('permisoAdd') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>Realmente desea eliminar este permiso?.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- @if ( $permisos != null ) --}}
    <div class="modal fade" id="permisoDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form" method="POST" action="/permisoDel" enctype="multipart/form-data" id="delPermisoForm">
                        @csrf
                    <div class="modal-body">
                        <p>Realmente desea eliminar este permiso?.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- @endif --}}

@push('custom-scripts')
<script type="text/javascript">
        $(document).ready(function() {
          $().ready(function() {
    
            var permisosTable = $('#permisoDatatable').DataTable();
            permisosTable.on('click', '.delPermiso', function(){
              $tr = $(this).closest('tr');
              if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
              }
    
              var data = permisosTable.row($tr).data();
              console.log(data);
              $("#permisoDelModal").modal('show');
              $("#delPermisoForm").attr('action', '/permisoDel/'+data[0]);
            });


          });
        });
      </script>
@endpush


@endsection