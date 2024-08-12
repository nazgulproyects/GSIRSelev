<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Puntos Recogida</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="PUNTOS RECOGIDA" imagen="{{ asset('images/punto_recogida.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalNuevoPuntoRecogida').modal('show');">Nuevo Punto Recogida</x-button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Cliente/Proveedor</th>
                                <th>Fecha recogida propuesta</th>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($puntos as $punto)
                            <tr>
                                <td><x-nav-link href="/puntos_recogida/{{$punto->id}}">{{ str_pad($punto->id, 4, '0', STR_PAD_LEFT) }}</x-nav-link></td>
                                <td>{{$punto->nombre}}</td>
                                <td>{{$punto->nombre_cli_prov}}</td>
                                <td>@if($punto->fecha_recogida_propuesta != null) {{ \Carbon\Carbon::parse($punto->fecha_recogida_propuesta)->format('d/m/Y') }} @endif</td>
                                <td>{{$punto->latitud}}</td>
                                <td>{{$punto->longitud}}</td>
                                <td><x-danger-button type="button" onclick="eliminarFila('{{$punto->id}}');"><i class="fa-solid fa-xmark"></i></x-danger-button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoPuntoRecogida">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>CREAR NUEVO PUNTO RECOGIDA</b></h4>
            </div>
            <form action='/puntos_recogida/create' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Nombre:</x-label>
                        <div class="col-sm-7">
                            <x-input type="text" name="nombre" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Latitud:</x-label>
                        <div class="col-sm-7">
                            <x-input type="text" name="latitud" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Longitud:</x-label>
                        <div class="col-sm-7">
                            <x-input type="text" name="longitud" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Clientes/Proveedores:</x-label>
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
                        <x-label class="col-sm-5 col-form-label">Contrato:</x-label>
                        <div class="col-sm-7">
                            <select name="contrato_id" class="form-control" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                @foreach($contratos as $contrato)
                                <option value="{{$contrato->id}}">{{$contrato->codigo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Crear Punto Recogida</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/puntos_recogida_destroy',
'texto' => '¿Estás seguro que quieres eliminar este punto de recogida?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function() {

        // Si los select2 que queremos estan dentro de un modal, deberemos poner esto
        $('select').select2({
            dropdownParent: $("#modalNuevoPuntoRecogida"),
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