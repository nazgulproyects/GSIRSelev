<x-app-layout>
    @section('rutas')
    <x-nav-link href="{{ route('vehiculos.index') }}"
        :active="request()->routeIs('vehiculos.index')">Vehículos</x-nav-link>
    <x-nav-link href="#" active="true">{{$vehiculo->nombre}} - {{$vehiculo->tipo}}</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">


            <form action='/vehiculos/update/{{$vehiculo->id}}' method="POST" enctype="multipart/form-data"
                class="form-horizontal">
                {{ csrf_field() }}

                <div class="row d-flex mb-2">
                    <div class="col-6 d-flex justify-content-start">
                        <x-main_title title="{{$vehiculo->nombre}} {{$vehiculo->tipo}}"
                            imagen="{{ asset('images/vehiculos.png') }}" />
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <x-button type="submit">Guardar</x-button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Nombre:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="text" name="nombre" class="form-control"
                                            value="{{$vehiculo->nombre}}"></x-input>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Tipo:</x-label>
                                    <div class="col-sm-9">
                                        <select name="tipo" id="tipo_select" class="form-control" style="width: 100%;">
                                            <option disabled selected value>Seleccionar tipo</option>
                                            <option value="Tractora">Tractora</option>
                                            <option value="Remolque">Remolque</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Matricula:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="text" name="matricula" class="form-control"
                                            value="{{$vehiculo->matricula}}"></x-input>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Seguro:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="date" name="seguro" class="form-control"
                                            value="{{$vehiculo->seguro}}"></x-input>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">ITV:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="date" name="itv" class="form-control"
                                            value="{{$vehiculo->itv}}"></x-input>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">ADR:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="date" name="adr" class="form-control"
                                            value="{{$vehiculo->adr}}"></x-input>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Ud. Medida:</x-label>
                                    <div class="col-sm-9">
                                        <select name="ud_medida" id="ud_medida_select" class="form-control"
                                            style="width: 100%;">
                                            <option disabled selected value>Seleccionar ud. medida</option>
                                            <option value="KG">KG</option>
                                            <option value="L">Litros</option>
                                            <option value="Bidones">Bidones</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Capacidad:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="number" step="0.01" name="capacidad" class="form-control"
                                            value="{{ $vehiculo->capacidad }}">
                                        </x-input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Empresa:</x-label>
                                    <div class="col-sm-9">
                                        <select name="empresa" id="empresa_select" class="form-control"
                                            style="width: 100%;">
                                            <option disabled selected value>Seleccionar empresa</option>
                                            <option value="EMPRESA 1">EMPRESA 1</option>
                                            <option value="EMPRESA 2">EMPRESA 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Estado:</x-label>
                                    <div class="col-sm-9">
                                        <select name="estado" id="estado_select" class="form-control"
                                            style="width: 100%;">
                                            <option disabled selected value></option>
                                            <option value="Alta">Alta</option>
                                            <option value="Baja">Baja</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Amortización:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="date" name="fecha_amortizacion" class="form-control" value="{{$vehiculo->fecha_amortizacion}}"></x-input>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <x-label class="col-sm-3 col-form-label">Tara:</x-label>
                                    <div class="col-sm-7">
                                        <x-input type="number" step="0.01" name="tara" class="form-control" value="{{$vehiculo->tara}}" style="text-align: right;"></x-input>
                                    </div>
                                    <div class="col-sm-2 text-start">Kg</div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <x-label class="col-sm-3 col-form-label">PMA:</x-label>
                                    <div class="col-sm-7">
                                        <x-input type="number" step="0.01" name="PMA" class="form-control" value="{{$vehiculo->PMA}}" style="text-align: right;"></x-input>
                                    </div>
                                    <div class="col-sm-2 text-start">Kg</div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <x-label class="col-sm-3 col-form-label">Carga Útil:</x-label>
                                    <div class="col-sm-7">
                                        <x-input type="number" step="0.01" name="carga_util" class="form-control" value="{{$vehiculo->carga_util}}" style="text-align: right;"></x-input>
                                    </div>
                                    <div class="col-sm-2 text-start">Kg</div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <x-label class="col-sm-3 col-form-label">Consumo:</x-label>
                                    <div class="col-sm-7">
                                        <x-input type="number" step="0.01" name="consumo" class="form-control" value="{{$vehiculo->consumo}}" style="text-align: right;"></x-input>
                                    </div>
                                    <div class="col-sm-2 text-start">L/100 Km</div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <x-label class="col-sm-3 col-form-label">Kilometraje:</x-label>
                                    <div class="col-sm-7">
                                        <x-input type="number" step="1" name="kilometraje" class="form-control"
                                            value="{{$vehiculo->kilometraje}}" style="text-align: right;"></x-input>
                                    </div>
                                    <div class="col-sm-2 text-start">
                                        Km
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row d-flex mb-2">
                            <div class="col-6 d-flex justify-content-start">
                                <b>MANTENIMIENTOS</b>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <x-button type="button" onclick="$('#modalNuevoMantenimiento').modal('show');">Nuevo
                                    mantenimiento</x-button>
                            </div>
                        </div>

                        <table id="table" class="display">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Coste</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($costes_mant as $coste_mant)
                                <tr>
                                    <td>
                                        @if($coste_mant->fecha != null)
                                        {{ \Carbon\Carbon::parse($coste_mant->fecha)->format('d/m/Y') }}
                                        @endif
                                    </td>
                                    <td>{{$coste_mant->descripcion}}</td>
                                    <td>{{$coste_mant->valor}} €</td>
                                    <td>
                                        <x-danger-button type="button" onclick="eliminarFila('{{$coste_mant->id}}');">
                                            <i class="fa-solid fa-xmark fa-fade"></i>
                                        </x-danger-button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoMantenimiento">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>NUEVO MANTENIMIENTO VEHÍCULO</b></h4>
            </div>
            <form action='/costes/create_mant/{{$vehiculo->id}}' method="POST" enctype="multipart/form-data"
                class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Fecha:</x-label>
                        <div class="col-sm-9">
                            <x-input type="datetime-local" name="fecha_mant" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Coste:</x-label>
                        <div class="col-sm-9">
                            <x-input type="number" step="0.01" name="coste_mant" class="form-control"
                                value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Descripción:</x-label>
                        <div class="col-sm-9">
                            <x-textarea name="descripcion_mant" class="form-control" rows="4"></x-textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button type="submit">Crear Mantenimiento</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/costes/destroy',
'texto' => '¿Estás seguro que quieres eliminar este mantenimiento?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function() {

        $('#tipo_mant').select2({
            dropdownParent: $("#modalNuevoMantenimiento"),
        });

        $('#tipo_select').val('{{$vehiculo->tipo}}').change();
        $('#ud_medida_select').val('{{$vehiculo->ud_medida}}').change();
        $('#empresa_select').val('{{$vehiculo->empresa}}').change();
        $('#estado_select').val('{{$vehiculo->estado}}').change();

        var table = $('#table').DataTable({
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