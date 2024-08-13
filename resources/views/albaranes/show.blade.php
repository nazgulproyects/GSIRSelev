<style>
    .boton-pdf {
        display: inline-block;
        background-color: #e74c3c;
        /* Color de fondo rojo */
        color: white;
        /* Color del texto */
        padding: 10px 20px;
        /* Espaciado interno */
        border-radius: 5px;
        /* Bordes redondeados */
        text-decoration: none;
        /* Quitar el subrayado del enlace */
        font-size: 16px;
        /* Tamaño de la fuente */
        font-weight: bold;
        /* Texto en negrita */
        transition: background-color 0.3s ease;
        /* Suaviza el cambio de color */
        margin-right: 10px;
    }

    .boton-pdf i {
        margin-right: 8px;
        /* Espacio entre el icono y el texto */
    }

    .boton-pdf:hover {
        background-color: #c0392b;
        /* Color de fondo al pasar el ratón */
    }
</style>
<x-app-layout>
    @section('rutas')
    <x-nav-link href="{{ route('albaranes.index') }}"
        :active="request()->routeIs('albaranes.index')">Albaranes</x-nav-link>
    <x-nav-link href="#" active="true">ALB_{{$albaran->id}}</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action='/albaranes/update/{{$albaran->id}}' method="POST" enctype="multipart/form-data"
                class="form-horizontal">
                {{ csrf_field() }}
                <div class="row d-flex mb-2">
                    <div class="col-6 d-flex justify-content-start">
                        <x-main_title title="ALB_{{$albaran->id}}" imagen="{{ asset('images/contratos.png') }}" />
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="/albaranes/pdf/{{$albaran->id}}" target="_blank" class="boton-pdf">
                            <i class="fa-solid fa-file-pdf"></i> Albarán PDF
                        </a>
                        <x-button type="submit">Guardar</x-button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group row">
                                    <x-label class="col-sm-2 col-form-label">Fecha:</x-label>
                                    <div class="col-sm-10">
                                        <x-input type="date" name="codigo" class="form-control"
                                            value="{{$albaran->fecha}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <x-label class="col-sm-2 col-form-label">Cliente:</x-label>
                                    <div class="col-sm-10">
                                        <select name="cli_prov_id" class="form-control" id="sel_cli_prov"
                                            style="width: 100%;">
                                            <option disabled selected>Seleccionar</option>
                                            @foreach($cli_provs as $cli_prov)
                                                <option value="{{$cli_prov->id}}">{{$cli_prov->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <x-label class="col-sm-2 col-form-label">Población:</x-label>
                                    <div class="col-sm-10">
                                        <x-input type="text" name="poblacion" class="form-control"
                                            value="{{$albaran->poblacion}}" />
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
                                <x-main_title title="PRODUCTOS" imagen="{{ asset('images/productos.png') }}" />
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <x-button type="button" onclick="$('#modalNuevoProdAlbaran').modal('show');">Añadir
                                    producto</x-button>
                            </div>
                        </div>
                        <table id="table" class="display">
                            <thead>
                                <tr>
                                    <th>Código Producto</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Unidades</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($albaran_prods as $alb_prod)
                                    <tr>
                                        <td>{{$alb_prod->producto->codigo}}</td>
                                        <td>{{$alb_prod->producto->descripcion}}</td>
                                        <th>{{$alb_prod->cantidad}}</th>
                                        <th>{{$alb_prod->producto->unidad_medida}}</th>
                                        <th></th>
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

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoProdAlbaran">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>AÑADIR PRODUCTO</b></h4>
            </div>
            <form action='/albaranes/asignar_prod_albaran/{{$albaran->id}}' method="POST" enctype="multipart/form-data"
                class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Producto:</x-label>
                        <div class="col-sm-9">
                            <select name="producto_id" class="form-control" id="select_modal" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->codigo}} - {{$producto->descripcion}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Cantidad:</x-label>
                        <div class="col-sm-9">
                            <x-input type="number" step="0.01" name="cantidad" class="form-control" value="" />
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
    $(document).ready(function () {

        // Si los select2 que queremos estan dentro de un modal, deberemos poner esto
        $('#select_modal').select2({
            dropdownParent: $("#modalNuevoProdAlbaran"),
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