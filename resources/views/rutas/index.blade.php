<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Rutas</x-nav-link>
    @endsection

    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="RUTAS" imagen="{{ asset('images/rutas.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalNuevaRuta').modal('show');">Nueva Ruta</x-button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Vehículo</th>
                                <th>Conductor</th>
                                <th>Hora Inicio Prop.</th>
                                <th>Hora Fin Prop.</th>
                                <th>Km inicio</th>
                                <th>Km fin</th>
                                <th>Empresa</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rutas as $ruta)
                            <tr>
                                <td><x-nav-link href="/rutas/{{$ruta->id}}">{{ str_pad($ruta->id, 4, '0', STR_PAD_LEFT) }}</x-nav-link></td>
                                <td>{{$ruta->nombre}}</td>
                                <td>@if($ruta->fecha != null) {{ \Carbon\Carbon::parse($ruta->fecha)->format('d/m/Y') }} @endif</td>
                                <td>{{$ruta->matricula_vehiculo}}</td>
                                <td>{{$ruta->nombre_conductor}}</td>
                                <td>{{ substr($ruta->hora_inicio_prop, 0, 5) }}</td>
                                <td>{{ substr($ruta->hora_fin_prop, 0, 5) }}</td>
                                <td>{{$ruta->km_inicio}}</td>
                                <td>{{$ruta->km_fin}}</td>
                                <td>{{$ruta->empresa}}</td>
                                <td><x-danger-button type="button" onclick="eliminarFila('{{$ruta->id}}');"><i class="fa-solid fa-xmark fa-fade"></i></x-danger-button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalNuevaRuta">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>CREAR NUEVA RUTA</b></h4>
            </div>
            <form action='/rutas/create' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Nombre:</x-label>
                        <div class="col-sm-7">
                            <x-input type="text" name="nombre" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Fecha:</x-label>
                        <div class="col-sm-7">
                            <x-input type="date" name="fecha" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Hora Inicio Propuesta:</x-label>
                        <div class="col-sm-7">
                            <x-input type="time" name="hora_inicio_prop" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Hora Fin Propuesta:</x-label>
                        <div class="col-sm-7">
                            <x-input type="time" name="hora_fin_prop" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Conductor:</x-label>
                        <div class="col-sm-7">
                            <select name="usuario_id" class="form-control" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                @foreach($conductores as $conductor)
                                <option value="{{$conductor->id}}">{{$conductor->name}} {{$conductor->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Vehículo:</x-label>
                        <div class="col-sm-7">
                            <select name="vehiculo_id" class="form-control" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                @foreach($vehiculos as $vehiculo)
                                <option value="{{$vehiculo->id}}">{{$vehiculo->matricula}} - {{$vehiculo->nombre}} ({{$vehiculo->tipo}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Km Inicio:</x-label>
                        <div class="col-sm-7">
                            <x-input type="number" name="km_inicio" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Km Fin:</x-label>
                        <div class="col-sm-7">
                            <x-input type="number" name="km_fin" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <x-label class="col-sm-5 col-form-label">Empresa:</x-label>
                        <div class="col-sm-7">
                            <select name="empresa" class="form-control" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                <option value="SELEV">SELEV</option>
                                <option value="REMITTEL">REMITTEL</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Crear Ruta</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/rutas_destroy',
'texto' => '¿Estás seguro que quieres eliminar esta ruta?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function() {

        // Si los select2 que queremos estan dentro de un modal, deberemos poner esto
        $('select').select2({
            dropdownParent: $("#modalNuevaRuta"),
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