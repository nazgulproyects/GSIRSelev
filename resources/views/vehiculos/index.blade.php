<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Vehículos</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="VEHÍCULOS" imagen="{{ asset('images/vehiculos.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalNuevoVehiculo').modal('show');">Nuevo Vehículo</x-button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Matricula</th>
                                <th>Seguro</th>
                                <th>ITV</th>
                                <th>ADR</th>
                                <th>Capacidad</th>
                                <th>Ud. Medida</th>
                                <th>Empresa</th>
                                <th>Estado</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehiculos as $vehiculo)
                            <tr>
                                <td><x-nav-link href="/vehiculos/{{$vehiculo->id}}">{{ str_pad($vehiculo->id, 4, '0', STR_PAD_LEFT) }}</x-nav-link></td>
                                <td>{{$vehiculo->nombre}}</td>
                                <td>{{$vehiculo->tipo}}</td>
                                <td>{{$vehiculo->matricula}}</td>
                                <td>@if($vehiculo->seguro != null) {{ \Carbon\Carbon::parse($vehiculo->seguro)->format('d/m/Y') }} @endif</td>
                                <td>@if($vehiculo->itv != null) {{ \Carbon\Carbon::parse($vehiculo->itv)->format('d/m/Y') }} @endif</td>
                                <td>@if($vehiculo->adr != null) {{ \Carbon\Carbon::parse($vehiculo->adr)->format('d/m/Y') }} @endif</td>
                                <td>{{$vehiculo->capacidad}}</td>
                                <td>{{$vehiculo->ud_medida}}</td>
                                <td>{{$vehiculo->empresa}}</td>
                                <td>{{$vehiculo->estado}}</td>
                                <td><x-danger-button type="button" onclick="eliminarFila('{{$vehiculo->id}}');"><i class="fa-solid fa-xmark"></i></x-danger-button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoVehiculo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>CREAR NUEVO VEHÍCULO</b></h4>
            </div>
            <form action='/vehiculos/create' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Nombre:</x-label>
                        <div class="col-sm-9">
                            <x-input type="text" name="nombre" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Tipo:</x-label>
                        <div class="col-sm-9">
                            <select name="tipo" class="form-control" style="width: 100%;">
                                <option disabled selected value>Seleccionar tipo</option>
                                <option value="Tractora">Tractora</option>
                                <option value="Remolque">Remolque</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Matricula:</x-label>
                        <div class="col-sm-9">
                            <x-input type="text" name="matricula" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Seguro:</x-label>
                        <div class="col-sm-9">
                            <x-input type="date" name="seguro" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">ITV:</x-label>
                        <div class="col-sm-9">
                            <x-input type="date" name="itv" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">ADR:</x-label>
                        <div class="col-sm-9">
                            <x-input type="date" name="adr" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Capacidad:</x-label>
                        <div class="col-sm-9">
                            <x-input type="number" step="0.01" name="capacidad" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Ud. Medida:</x-label>
                        <div class="col-sm-9">
                            <select name="ud_medida" class="form-control" style="width: 100%;">
                                <option disabled selected value>Seleccionar ud. medida</option>
                                <option value="KG">KG</option>
                                <option value="L">L</option>
                                <option value="Bidones">Bidones</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Empresa:</x-label>
                        <div class="col-sm-9">
                            <select name="empresa" class="form-control" style="width: 100%;">
                                <option disabled selected value>Seleccionar empresa</option>
                                <option value="EMPRESA 1">EMPRESA 1</option>
                                <option value="EMPRESA 2">EMPRESA 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Tara:</x-label>
                        <div class="col-sm-9">
                            <x-input type="number" step="0.01" name="tara" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">PMA:</x-label>
                        <div class="col-sm-9">
                            <x-input type="number" step="0.01" name="PMA" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Carga Útil:</x-label>
                        <div class="col-sm-9">
                            <x-input type="number" step="0.01" name="carga_util" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Estado:</x-label>
                        <div class="col-sm-9">
                            <x-input type="text" name="estado" class="form-control" value="Alta" readonly></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Consumo:</x-label>
                        <div class="col-sm-9">
                            <x-input type="number" step="0.01" name="consumo" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Kilometraje:</x-label>
                        <div class="col-sm-9">
                            <x-input type="number" step="1" name="kilometraje" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Fecha amortización:</x-label>
                        <div class="col-sm-9">
                            <x-input type="date" name="fecha_amortizacion" class="form-control" value=""></x-input>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Crear Vehículo</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/vehiculos/destroy',
'texto' => '¿Estás seguro que quieres eliminar este vehiculo?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function() {

        $('select').select2({
            dropdownParent: $("#modalNuevoVehiculo"),
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