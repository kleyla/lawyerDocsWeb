@extends('layouts.admin')
@section('clientes','active')
@section('contenido')


<div class="content">
    <div class="row">
        <div class="col-md-9">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Documentos del expediente {{$expediente->descripcion}} </h4>
                    <Button class="btn-icon btn-primary alingleft" size="sm" data-toggle="modal" data-target="#docAdd">
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
                        <table class="table tablesorter " id="tdoc">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Numero</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">User</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documentos as $documento)
                                <tr>
                                    <td>{{ $documento->id }}</td>
                                    <td class="text-center">{{ $documento->descripcion }}</td>
                                    <td class="text-center">{{ $documento->created_at }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('clienteEdit', $documento->id) }}" title="Ver documentos">
                                            <Button class="btn-icon btn-info" size="sm">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </Button>
                                        </a>
                                        <a href="{{ route('clienteEdit', $documento->id) }}" title="Editar datos">
                                            <Button class="btn-icon btn-success alingleft" size="sm">
                                                <i class="tim-icons icon-pencil"></i>
                                            </Button>
                                        </a>
                                        <Button class="btn-icon btn-danger" size="sm" data-toggle="modal"
                                            data-target="#expArch" title="Archivar">
                                            <i class="tim-icons icon-paper"></i>
                                        </Button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- USUARIOS DESIGNADOS AL CASO --}}
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title text-success"> Usuarios designados al expediente </h4>
                    @if (Auth::user()->permiso_id == 1 || Auth::user()->permiso_id == 2 )
                    <Button class="btn-icon btn-primary alingleft" size="sm" data-toggle="modal"
                        data-target="#expUserAdd">
                        <i class="tim-icons icon-simple-add"></i>
                    </Button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="userDatatable">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}
                                        @if ($user->permiso_id == 2)
                                        (Abogado)
                                        @else
                                        (Pasante)
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="photo">
                                            <img src="{{asset("img/users/$user->photo")}}" alt="Profile Photo">
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <Button class="btn-icon btn-info" size="sm" data-toggle="modal"
                                            data-target="#userVerModal" title="Ver info">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </Button>
                                        @if (Auth::user()->permiso_id == 1 || Auth::user()->permiso_id == 2 )
                                        <Button class="btn-icon btn-danger deluser" size="sm" data-toggle="modal"
                                            data-target="#userDelModal" title="Eliminar">
                                            <i class="tim-icons icon-trash-simple"></i>
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

                            <h5 class="title">Expediente: {{$expediente->id}} </h5>
                            <p class="description">{{ $expediente->descripcion }} </p>
                        </div>
                    </p>
                    <div class="card-description">
                        <h5>Fecha de inicio: {{ $expediente->created_at }}</h5>
                    </div>
                </div>
            </div>

            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <h5 class="title">Cliente: {{ $cliente->nombres }} {{ $cliente->apellidos }}</h5>
                            {{-- <p>Numero de telefono: </p>
                            <p class="description">{{ $cliente->numero }}
                    </p> --}}
                </div>
                </p>
                <div class="card-description">
                    <h5>Nombres: {{ $cliente->nombres }}</h5>
                    <h5>Apellidos: {{ $cliente->apellidos }}</h5>
                    <h5>CI: {{ $cliente->ci }}</h5>
                    <h5>Numero de telefono: {{ $cliente->numero }}</h5>
                    <h5>Direccion: {{ $cliente->direccion }}</h5>
                    <h5>Genero: {{ $cliente->genero }}</h5>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<div class="modal modal-black show" id="docAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="POST" action="{{ route('expedienteAdd', $cliente->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descripcion del expediente</label>
                        <textarea name="descripcion" id="descripcion" class="form-control"
                            id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="col-md-12">
                        <fieldset>
                            <label class="form-control-label" for="input-first-name">Seleccionar documento</label> <br>
                            <section class="">
                                <input type="file" name="doc" id="doc">
                            </section>
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a id="btn-firebase" type="button" class="btn btn-primary">Guardar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-black show" id="expUserAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary" id="exampleModalLabel">Agregar pasnte al expediente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="POST" action="{{ route('expUsersAdd', $expediente->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
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
                                @foreach ($usersNew as $userNew)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox"
                                                    name="pasantes{{$userNew->id}}" value="{{ $userNew->id }}">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $userNew->id }}</td>
                                    <td>{{ $userNew->nombres }} {{ $userNew->apellidos }}</td>
                                    <td>
                                        <div class="photo">
                                            <img src="{{asset("img/users/$userNew->photo")}}" alt="Profile Photo">
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

@if ($documentos != null)
<div class="modal" id="expArch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Archivar expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="POST" action="{{ route('expedienteArchivar', $documento->id) }}"
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
@endif

@if ($users != null)
<div class="modal modal-black" id="userVerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Informacion del Pasante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Nombres: {{ $user->nombres }}</h5>
                <h5>Apellidos: {{ $user->apellidos }}</h5>
                <h5>CI: {{ $user->ci }}</h5>
                <h5>Numero: {{ $user->numero }}</h5>
                <h5>Direccion: {{ $user->direccion }}</h5>
                <h5>Genero: {{ $user->genero }}</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="userDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario del expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delUserForm" class="form" method="POST" action="/userDelExp" enctype="multipart/form-data"
                id="delUserForm">
                @csrf
                <div class="modal-body">
                    <p>Realmente desea eliminar este usuario?.</p>
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

                var usersTable = $('#userDatatable').DataTable();
                usersTable.on('click', '.deluser', function(){
                  $tr = $(this).closest('tr');
                  if($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent');
                  }

                  var data = usersTable.row($tr).data();
                  console.log(data);
                  $("#userDelModal").modal('show');
                  $('#delUserForm').attr('action', '/userDelExp/'+data[0]);
                });
                var exp = @JSON($expediente);
                console.log('El EXP ES '+exp);
                var tasksRef = firebase.database().ref('documentos/' + exp.id);
                tasksRef.on('value', dataSnapshot => {
                var tasks = [];
                dataSnapshot.forEach(child => {
                    tasks.push({
                    nombre: child.val().nombre,
                    doc: child.val().doc,
                    user_id: child.val().user_id,
                    fecha: child.val().fecha,
                    key: child.key,
                    });
                    $('#tdoc tbody').append("<tr>"+"<td>"+child.val().nombre+"</td>"+"<td>"+child.val().fecha+"</td>"+"<td>"+child.val().user_id+"</td>"+"<td><a href="+child.val().doc+" title='Descargar'><Button class='btn-icon btn-info'  size='sm'><i class='tim-icons icon-cloud-download-93'></i></Button></a></td></tr>");
                    console.log('Los DOCS  ' + tasks);
                });
                // document.getElementById("caja_valor").value = tasks[0].doc;
                var documentos = tasks;
                console.log('Los DOCS SON ' + tasks);
                });
            });
        });

        $('#btn-firebase').on('click', function() {
            let email = document.querySelector('#email').value;
            let password = document.querySelector('#password').value;
            console.log("Before firebase")
            firebase
            .auth()
            .createUserWithEmailAndPassword(email, password)
            .then(user => {
            console.log(user);
            //   $('#registrationform').attr('action', '/userAdd');
            });
        })
</script>
@endpush


@endsection
