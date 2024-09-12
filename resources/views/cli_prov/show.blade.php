<x-app-layout>
    @section('rutas')
    <x-nav-link href="{{ route('cli_prov.index') }}" :active="request()->routeIs('cli_prov.index')">Clientes /
        Proveedores</x-nav-link>
    <x-nav-link href="#" active="true">{{$cli_prov->nombre}}</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action='/cli_prov/update/{{$cli_prov->id}}' method="POST" enctype="multipart/form-data"
                class="form-horizontal">
                {{ csrf_field() }}

                <div class="row d-flex mb-2">
                    <div class="col-6 d-flex justify-content-start">
                        <x-main_title title="{{$cli_prov->nombre}}" imagen="{{ asset('images/cli_prov.png') }}" />
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <x-button type="submit">Guardar</x-button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Nombre:</x-label>
                            <div class="col-sm-10">
                                <x-input type="text" name="nombre" class="form-control" value="{{$cli_prov->nombre}}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Fecha Antigüedad:</x-label>
                            <div class="col-sm-10">
                                <x-input type="date" name="fecha_antiguedad" class="form-control"
                                    value="{{$cli_prov->fecha_antiguedad}}"></x-input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Tramo Actual Comisión:</x-label>
                            <div class="col-sm-10">
                                <x-input type="text" name="tramo_actual_comision" class="form-control"
                                    value="{{$cli_prov->tramo_actual_comision}}"></x-input>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COMERCIALES ASIGNADOS -->
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row d-flex mb-2">
                            <div class="col-6 d-flex justify-content-start">
                                <x-main_title title="COMERCIALES ASIGNADOS" imagen="{{ asset('images/comerciales.png') }}" />
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <x-button type="button" onclick="$('#modalAsignarComercial').modal('show');">ASIGNAR COMERCIAL</x-button>
                            </div>
                        </div>

                        <table id="tabla_comerciales" class="display">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Latitud</th>
                                    <th>Longitud</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><x-nav-link href="/puntos_recogida/"></x-nav-link></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- PUNTOS RECOGIDA -->
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row d-flex mb-2">
                            <div class="col-6 d-flex justify-content-start">
                                <x-main_title title="PUNTOS RECOGIDA"
                                    imagen="{{ asset('images/punto_recogida.png') }}" />
                            </div>
                            <div class="col-6 d-flex justify-content-end">

                            </div>
                        </div>
                        <table id="table" class="display">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Latitud</th>
                                    <th>Longitud</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($puntos_recogida as $pr)
                                <tr>
                                    <td><x-nav-link href="/puntos_recogida/{{$pr->id}}">{{$pr->nombre}}</x-nav-link>
                                    </td>
                                    <td>{{$pr->latitud}}</td>
                                    <td>{{$pr->longitud}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- CONTRATOS -->
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row d-flex mb-2">
                            <div class="col-6 d-flex justify-content-start">
                                <x-main_title title="CONTRATOS" imagen="{{ asset('images/contratos.png') }}" />
                            </div>
                            <div class="col-6 d-flex justify-content-end">

                            </div>
                        </div>
                        <table id="tabla_contratos" class="display">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Punto de recogida</th>
                                    <th>Fecha recogida inicial</th>
                                    <th>Fecha recogida propuesta </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contratos as $contrato)
                                <tr>
                                    <td><x-nav-link
                                            href="/contratos/{{$contrato->id}}">{{$contrato->codigo}}</x-nav-link></td>
                                    <td><x-nav-link
                                            href="/puntos_recogida/{{$contrato->punto_recogida_id}}">{{$contrato->NombrePR}}</x-nav-link>
                                    </td>
                                    <td>
                                        @if($contrato->fecha_recogida_inicial != null)
                                        {{ \Carbon\Carbon::parse($contrato->fecha_recogida_inicial)->format('d/m/Y') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($contrato->fecha_recogida_propuesta != null)
                                        {{ \Carbon\Carbon::parse($contrato->fecha_recogida_propuesta)->format('d/m/Y') }}
                                        @endif
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

<div class="modal" tabindex="-1" role="dialog" id="modalAsignarComercial">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>ASIGNAR COMERCIAL</b></h4>
            </div>
            <form action='/costes/create_mant/' method="POST" enctype="multipart/form-data"
                class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Comerciales:</x-label>
                        <div class="col-sm-9">
                            <select name="estado" id="estado_select" class="form-control" style="width: 100%;">
                                <option disabled selected value></option>
                                @foreach ($comerciales as $comercial)
                                <option value="{{$comercial->id}}">{{$comercial->name}} {{$comercial->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button type="submit">Asignar comercial</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
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
            bPaginate: false,
            bFilter: false,
            showNEntries: false,
            lengthChange: false,
            'language': {
                'paginate': {
                    'previous': 'Anterior',
                    'next': 'Siguiente'
                }
            }

        });

        var tabla_contratos = $('#tabla_contratos').DataTable({
            responsive: true,
            autoWidth: false,
            'oLanguage': {
                'sSearch': 'Buscar:'
            },
            'scrollX': true,
            'order': [],
            'lengthMenu': [30],
            bInfo: false,
            bPaginate: false,
            bFilter: false,
            showNEntries: false,
            lengthChange: false,
            'language': {
                'paginate': {
                    'previous': 'Anterior',
                    'next': 'Siguiente'
                }
            }

        });

        var tabla_comerciales = $('#tabla_comerciales').DataTable({
            responsive: true,
            autoWidth: false,
            'oLanguage': {
                'sSearch': 'Buscar:'
            },
            'scrollX': true,
            'order': [],
            'lengthMenu': [30],
            bInfo: false,
            bPaginate: false,
            bFilter: false,
            showNEntries: false,
            lengthChange: false,
            'language': {
                'paginate': {
                    'previous': 'Anterior',
                    'next': 'Siguiente'
                }
            }

        });
    })
</script>

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')