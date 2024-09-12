<x-app-layout>
    @section('rutas')
    <x-nav-link href="{{ route('empleados.index') }}"
        :active="request()->routeIs('empleados.index')">Empleados</x-nav-link>
    <x-nav-link href="#" active="true">{{$empleado->name}} {{$empleado->surname}}</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">


            <form action='/empleados/{{$empleado->id}}' method="POST" enctype="multipart/form-data"
                class="form-horizontal">
                {{ csrf_field() }}

                <div class="row d-flex mb-2">
                    <div class="col-6 d-flex justify-content-start">
                        <x-main_title title="{{$empleado->name}} {{$empleado->surname}} ({{$empleado->tipo}})"
                            imagen="{{ asset('images/usuarios.png') }}" />
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <x-button type="submit">Guardar</x-button>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <x-label class="col-sm-2 col-form-label">Nombre:</x-label>
                                    <div class="col-sm-10">
                                        <x-input type="text" name="name" class="form-control"
                                            value="{{$empleado->name}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-2 col-form-label">Apellidos:</x-label>
                                    <div class="col-sm-10">
                                        <x-input type="text" name="surname" class="form-control"
                                            value="{{$empleado->surname}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-2 col-form-label">Email:</x-label>
                                    <div class="col-sm-10">
                                        <x-input type="email" name="email" class="form-control"
                                            value="{{$empleado->email}}" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <x-label class="col-sm-2 col-form-label">DNI:</x-label>
                                    <div class="col-sm-10">
                                        <x-input type="text" name="dni" class="form-control"
                                            value="{{$empleado->dni}}"></x-input>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-2 col-form-label">Teléfono:</x-label>
                                    <div class="col-sm-10">
                                        <x-input type="text" name="telefono" class="form-control"
                                            value="{{$empleado->telefono}}"></x-input>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-2 col-form-label">Tipo:</x-label>
                                    <div class="col-sm-10">
                                        <select name="tipo" id="tipo_select" class="form-control" style="width: 100%;">
                                            <option disabled selected value>Seleccionar tipo</option>
                                            <option value="Comercial">Comercial</option>
                                            <option value="Conductor">Conductor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Username:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="text" name="username" class="form-control" value="{{$empleado->username}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Contraseña:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="password" name="password" class="form-control" value=""></x-input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        @if($empleado->tipo == 'Comercial')
                            <b>CLIENTES / COMISIONES</b>
                            <table id="tabla_comisiones" class="display">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Comisión</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="form-group row">
                                <x-label class="col-sm-2 col-form-label">Horas Totales Conducción:</x-label>
                                <div class="col-sm-10">
                                    <x-input type="text" name="horasTotalesConduccion" class="form-control"
                                        value="{{$empleado->horasTotalesConduccion}}" />
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>



<script>
    $(document).ready(function () {

        $('#tipo_select').val('{{$empleado->tipo}}').change();
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

        var table = $('#tabla_comisiones').DataTable({
            responsive: true,
            autoWidth: false,
            'oLanguage': {
                'sSearch': 'Buscar:'
            },
            'scrollX': true,
            'order': [],
            'lengthMenu': [30],
            bFilter: false,
            bPaginate: false,
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

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')