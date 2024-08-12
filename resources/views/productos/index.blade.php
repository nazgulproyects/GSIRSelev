<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Productos</x-nav-link>
    @endsection

    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="PRODUCTOS" imagen="{{ asset('images/productos.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalNuevoProducto').modal('show');">Nuevo Producto</x-button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Unidad Medida</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td><x-nav-link href="/productos/{{$producto->id}}">{{ str_pad($producto->id, 4, '0', STR_PAD_LEFT) }}</x-nav-link></td>
                                <td>{{$producto->codigo}}</td>
                                <td>{{$producto->descripcion}}</td>
                                <td>{{$producto->tipo}}</td>
                                <td>{{$producto->unidad_medida}}</td>
                                <td><x-danger-button type="button" onclick="eliminarFila('{{$producto->id}}');"><i class="fa-solid fa-xmark fa-fade"></i></x-danger-button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoProducto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>CREAR NUEVO PRODUCTO</b></h4>
            </div>
            <form action='/productos/create' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Código:</x-label>
                        <div class="col-sm-7">
                            <x-input type="text" name="codigo" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Descripción:</x-label>
                        <div class="col-sm-7">
                            <x-input type="text" name="descripcion" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Tipo:</x-label>
                        <div class="col-sm-7">
                            <select name="tipo" class="form-control" style="width: 100%;">
                                <option disabled selected value>Seleccionar empresa</option>
                                <option value="PRODUCTO">PRODUCTO</option>
                                <option value="ENVASE">ENVASE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Unidad Medida:</x-label>
                        <div class="col-sm-7">
                            <select name="unidad_medida" class="form-control" style="width: 100%;">
                                <option disabled selected value></option>
                                <option value="KG">KG</option>
                                <option value="UDS">UDS</option>
                                <option value="L">L</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Crear Producto</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/productos/destroy',
'texto' => '¿Estás seguro que quieres eliminar este producto?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function() {

        $('select').select2({
            dropdownParent: $("#modalNuevoProducto"),
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