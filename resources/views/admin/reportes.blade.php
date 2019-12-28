@extends('layouts.admin')
@section('reportes','active')
@section('contenido')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Reportes </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="userDatatable">
                            <thead class="text-primary">
                                <tr>
                                    <th>Nro</th>
                                    <th>Tipo</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <form class="form" method="POST" action="{{ route('usuariosRep')}}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <td>1</td>
                                        <td>Usuarios</td>
                                        <td>
                                            <input type="date" class="form-control" id="fecha_ini_user"
                                                name="fecha_ini_user">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" id="fecha_fin_user"
                                                name="fecha_fin_user">
                                        </td>
                                        <td class="text-center">
                                            <Button class="btn-icon btn-info" size="sm">
                                                <i class="tim-icons icon-cloud-download-93"></i>
                                            </Button>

                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form class="form" method="POST" action="{{ route('clientesRep')}}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <td>1</td>
                                        <td>Clientes</td>
                                        <td>
                                            <input type="date" class="form-control" id="fecha_ini_cli"
                                                name="fecha_ini_cli">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" id="fecha_fin_cli"
                                                name="fecha_fin_cli">
                                        </td>
                                        <td class="text-center">
                                            <Button class="btn-icon btn-info" size="sm">
                                                <i class="tim-icons icon-cloud-download-93"></i>
                                            </Button>

                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form class="form" method="POST" action="{{ route('expRep')}}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <td>1</td>
                                        <td>Cliente expedientes</td>
                                        <td>
                                            <small>Seleccionar el cliente para obtener sus expedientes</small>
                                            {{-- <input type="date" class="form-control" id="fecha_ini" name="fecha_ini"> --}}
                                        </td>
                                        <td>
                                            <select name="cliente" class="form-control selectpicker"
                                                data-style="btn btn-link" id="cliente">
                                                @foreach ($clientes as $cliente)
                                                <option name="cliente" value="{{ $cliente->id }}">
                                                    {{ $cliente->nombres }} {{ $cliente->apellidos }}
                                                </option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"> --}}
                                        </td>
                                        <td class="text-center">
                                            <Button class="btn-icon btn-info" size="sm">
                                                <i class="tim-icons icon-cloud-download-93"></i>
                                            </Button>

                                        </td>
                                    </form>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
