<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Contratos</x-nav-link>
    @endsection

    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="CONTRATOS" imagen="{{ asset('images/contratos.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalNuevoContrato').modal('show');">Nuevo Contrato</x-button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Código</th>
                                <th>Cliente/Proveedor</th>
                                <th>Punto de recogida</th>
                                <th>Fecha recogida inicial</th>
                                <th>Frecuencia recogida</th>
                                <th>Coste Unitario</th>
                                <th>Tipo</th>
                                <th>PDF</th>
                                <th>Eliminarr</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contratos as $contrato)
                            <tr>
                                <td><x-nav-link href="/contratos/{{$contrato->id}}">{{ str_pad($contrato->id, 4, '0', STR_PAD_LEFT) }}</x-nav-link></td>
                                <td>{{ $contrato->codigo }}</td>
                                <td><x-nav-link href="/cli_prov/{{$contrato->cli_prov_id}}">{{ $contrato->NombreCliProv }}</x-nav-link></td>
                                <td><x-nav-link href="/puntos_recogida/{{$contrato->punto_recogida_id}}">{{ $contrato->NombrePR }}</x-nav-link></td>
                                <td>@if($contrato->fecha_recogida_inicial != null) {{ \Carbon\Carbon::parse($contrato->fecha_recogida_inicial)->format('d/m/Y') }} @endif</td>
                                <td>{{$contrato->frecuencia}} días</td>
                                <td>@if($contrato->coste_unitario != null) {{$contrato->coste_unitario}} € @endif</td>
                                <td>{{$contrato->tipo}}</td>
                                <td><a href="/contratos/pdf/{{$contrato->id}}" target="_blank"><i class="fa-solid fa-file-pdf" style="color: red;"></i></a> </td>
                                <td><x-danger-button type="button" onclick="eliminarFila('{{$contrato->id}}');"><i class="fa-solid fa-xmark fa-fade"></i></x-danger-button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoContrato">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>CREAR NUEVO CONTRATO</b></h4>
            </div>
            <form action='/contratos/create' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Código:</x-label>
                        <div class="col-sm-7">
                            <x-input type="text" name="codigo" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Cliente/Proveedor:</x-label>
                        <div class="col-sm-7">
                            <select name="cli_prov_id" class="form-control" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                @foreach($cli_provs as $cli_prov)
                                <option value="{{$cli_prov->id}}">{{$cli_prov->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Punto de recogida:</x-label>
                        <div class="col-sm-7">
                            <select name="punto_recogida_id" class="form-control" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                @foreach($puntos_recogida as $pr)
                                <option value="{{$pr->id}}">{{$pr->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Fecha recogida inicial:</x-label>
                        <div class="col-sm-7">
                            <x-input type="date" name="fecha_recogida_inicial" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Frecuencia recogida:</x-label>
                        <div class="col-sm-5">
                            <x-input type="number" step='1' name="frecuencia" class="form-control" value=""></x-input>
                        </div>
                        días
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Coste Unitario:</x-label>
                        <div class="col-sm-5">
                            <x-input type="number" step="0.01" name="coste_unitario" class="form-control" value=""></x-input>
                        </div>
                        €
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Tipo:</x-label>
                        <div class="col-sm-7">
                            <select name="tipo" class="form-control" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                <option value="RECOGIDA">RECOGIDA</option>
                                <option value="MAQUILA">MAQUILA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Crear Contrato</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/contratos/destroy',
'texto' => '¿Estás seguro que quieres eliminar esta contrato?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function() {

        // Si los select2 que queremos estan dentro de un modal, deberemos poner esto
        $('select').select2({
            dropdownParent: $("#modalNuevoContrato"),
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