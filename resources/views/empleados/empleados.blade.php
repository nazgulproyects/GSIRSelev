<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Empleados</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="EMPLEADOS" imagen="{{ asset('images/usuarios.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalNuevoEmpleado').modal('show');">Nuevo Empleado</x-button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Horas Totales Conducción</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados as $empleado)
                            <tr>
                                <td><x-nav-link href="/empleados/{{$empleado->id}}">{{ str_pad($empleado->id, 4, '0', STR_PAD_LEFT) }}</x-nav-link></td>
                                <td>{{$empleado->name}}</td>
                                <td>{{$empleado->surname}}</td>
                                <td>{{$empleado->email}}</td>
                                <td>{{$empleado->tipo}}</td>
                                <td>{{$empleado->horasTotalesConduccion}}</td>
                                <td><x-danger-button type="button" onclick="eliminarFila('{{$empleado->id}}');"><i class="fa-solid fa-xmark"></i></x-danger-button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoEmpleado">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>CREAR NUEVO EMPLEADO</b></h4>
            </div>



            <form action='/empleados/create' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Nombre:</x-label>
                        <div class="col-sm-9">
                            <x-input type="text" name="name" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Apellidos:</x-label>
                        <div class="col-sm-9">
                            <x-input type="text" name="surname" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Email:</x-label>
                        <div class="col-sm-9">
                            <x-input type="email" name="email" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Contraseña:</x-label>
                        <div class="col-sm-9">
                            <x-input type="password" name="password" class="form-control" value=""></x-input>
                        </div>
                    </div>

                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Tipo:</x-label>
                        <div class="col-sm-9">
                            <select name="tipo" class="form-control" style="width: 100%;">
                                <option disabled selected value>Seleccionar tipo</option>
                                <option value="Comercial">Comercial</option>
                                <option value="Conductor">Conductor</option>
                            </select>
                        </div>
                    </div>
                    <!-- 
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Conductor:</x-label>
                        <div class="col-sm-9">
                            <x-checkbox name="conductor" class="mt-2" campo=''></x-checkbox>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Crear Empleado</x-button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/empleados_destroy',
'texto' => '¿Estás seguro que quieres eliminar este empleado?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function() {

        $('select').select2({
            dropdownParent: $("#modalNuevoEmpleado"),
        });

        var table = $('#table').DataTable({
            responsive: true,
            autoWidth: false,
            'oLanguage': {
                'sSearch': 'Buscar:'
            },
            'scrollX': true,
            'order': [],
            'lengthMenu': [30],
            bInfo: false,
            showNEntries: false,
            lengthChange: false,
            'language': {
                'paginate': {
                    'previous': 'Anterior',
                    'next': 'Siguiente'
                }
            }

        })
    })
</script>