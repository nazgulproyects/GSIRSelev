<x-app-layout>
    @section('rutas')
    <x-nav-link href="{{ route('contratos.index') }}" :active="request()->routeIs('contratos.index')">Contratos</x-nav-link>
    <x-nav-link href="#" active="true">{{$contrato->codigo}}</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action='/contratos/update/{{$contrato->id}}' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row d-flex mb-2">
                    <div class="col-6 d-flex justify-content-start">
                        <x-main_title title="{{$contrato->codigo}}" imagen="{{ asset('images/contratos.png') }}" />
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <x-button type="submit">Guardar</x-button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Código:</x-label>
                            <div class="col-sm-10">
                                <x-input type="text" name="codigo" class="form-control" value="{{$contrato->codigo}}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Cliente/Proveedor:</x-label>
                            <div class="col-sm-10">
                                <select name="cli_prov_id" class="form-control" id="sel_cli_prov" style="width: 100%;">
                                    <option disabled selected>Seleccionar</option>
                                    @foreach($cli_provs as $cli_prov)
                                    <option value="{{$cli_prov->id}}">{{$cli_prov->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <x-label class="col-sm-2 col-form-label">Punto de recogida:</x-label>
                            <div class="col-sm-4">
                                <select name="punto_recogida_id" class="form-control" id="sel_pr" style="width: 100%;">
                                    <option disabled selected>Seleccionar</option>
                                    @foreach($puntos_recogida as $pr)
                                    <option value="{{$pr->id}}">{{$pr->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-label class="col-sm-6 col-form-label">
                                Asignado a alguna ruta?:
                                @if($contrato->punto_recogida->asignado_a_ruta)
                                <b style="color: green;"><x-nav-link href="/rutas/{{$contrato->punto_recogida->asignado_a_ruta}}">Ruta {{$contrato->punto_recogida->asignado_a_ruta}}</x-nav-link></b>
                                @else
                                <b style="color: red;">NO</b>
                                @endif
                            </x-label>
                        </div>
                        <hr>
                        <div class="form-group row mt-2">
                            <x-label class="col-sm-2 col-form-label">Fecha recogida inicial:</x-label>
                            <div class="col-sm-10">
                                <x-input type="date" name="fecha_recogida_inicial" class="form-control" value="{{$contrato->fecha_recogida_inicial }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Próxima fecha recogida:</x-label>
                            <div class="col-sm-10">
                                <x-input type="date" name="prox_dia_recogida" class="form-control" value="{{$contrato->prox_dia_recogida }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Frecuencia recogida:</x-label>
                            <div class="col-sm-10">
                                <x-input type="number" step="1" name="frecuencia" class="form-control" value="{{$contrato->frecuencia}}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Coste Unitario:</x-label>
                            <div class="col-sm-10">
                                <x-input type="number" step="0.01" name="coste_unitario" class="form-control" value="{{$contrato->coste_unitario}}"></x-input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Tipo:</x-label>
                            <div class="col-sm-10">
                                <select name="tipo" id="tipo_select" class="form-control" style="width: 100%;">
                                    <option disabled selected>Seleccionar</option>
                                    <option value="RECOGIDA">RECOGIDA</option>
                                    <option value="MAQUILA">MAQUILA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row d-flex mb-2">
                            <div class="col-6 d-flex justify-content-start">
                                <x-main_title title="PRODUCTOS" imagen="{{ asset('images/productos.png') }}" />
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <x-button type="button" onclick="$('#modalNuevoProdContrato').modal('show');">Añadir producto</x-button>
                            </div>
                        </div>
                        <table id="table" class="display">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productos_contrato as $prod_cont)
                                <tr>
                                    <td>{{$prod_cont->producto->nombre}}</td>
                                    <td><x-danger-button type="button" onclick="eliminarFila('{{$prod_cont->id}}');"><i class="fa-solid fa-xmark fa-fade"></i></x-danger-button></td>
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

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoProdContrato">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>AÑADIR PRODUCTO</b></h4>
            </div>
            <form action='/contratos/asignar_prod_contrato/{{$contrato->id}}' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Producto:</x-label>
                        <div class="col-sm-7">
                            <select name="producto_id" class="form-control" id="select_modal" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                @foreach($productos as $producto)
                                <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Añadir</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/contratos/eliminar_prod',
'texto' => '¿Estás seguro que quieres eliminar este producto del contrato?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function() {

        $('#tipo_select').val('{{$contrato->tipo}}').change();

        // Si los select2 que queremos estan dentro de un modal, deberemos poner esto
        $('#select_modal').select2({
            dropdownParent: $("#modalNuevoProdContrato"),
        });

        $('#sel_cli_prov').val('{{$contrato->cli_prov_id}}').change();
        $('#sel_pr').val('{{$contrato->punto_recogida_id}}').change();

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

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')