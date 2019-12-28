@extends('layouts.admin')
@section('users','active')
@section('contenido')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Usuarios </h4>
                    <Button class="btn-icon btn-primary alingleft" size="sm" data-toggle="modal" data-target="#userAdd">
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
                        <table class="table tablesorter " id="userDatatable">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Nro</th>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th class="text-center">Fecha</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}
                                        @if ($user->permiso_id == 1)
                                        (Administrador)
                                        @endif
                                        @if ($user->permiso_id == 2)
                                        (Abogado)
                                        @endif
                                        @if ($user->permiso_id == 3)
                                        (Pasante)
                                        @endif
                                    </td>
                                    <td>
                                        <div class="photo">
                                            <img src="{{asset("img/users/$user->photo")}}" alt="Profile Photo">
                                        </div>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">{{ $user->created_at }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('userVer', $user->id) }}" title="Editar">
                                            <Button class="btn-icon btn-info" size="sm">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </Button>
                                        </a>

                                        <a href="{{ route('userEdit', $user->id) }}" title="Editar">
                                            <Button class="btn-icon btn-success alingleft" size="sm">
                                                <i class="tim-icons icon-pencil"></i>
                                            </Button>
                                        </a>
                                        <Button class="btn-icon btn-danger deluser" size="sm" data-toggle="modal"
                                            data-target="#userDelModal" title="Eliminar">
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

<div class="modal modal-black show" id="userAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edita tus datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="POST" action="{{ route('userAdd')}}" id="registrationform"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contrasena"
                        required>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Seleccione el permiso</label>
                        <select name="permiso" class="form-control selectpicker" data-style="btn btn-link" id="permiso">
                            @foreach ($permisos as $permiso)
                            <option name="permiso" value="{{ $permiso->id }}">{{ $permiso->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <fieldset>
                            <label class="form-control-label" for="input-first-name">Seleccionar foto de perfil</label>
                            <br>
                            <section class="">
                                <input type="file" name="photo" id="photo">
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

@if ( $users != null )
<div class="modal fade" id="userDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delUserForm" class="form" method="POST" action="/userDel" enctype="multipart/form-data">
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
