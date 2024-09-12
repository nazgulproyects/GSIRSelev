<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Clientes/Proveedores</x-nav-link>
    @endsection

    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="CLIENTES / PROVEEDORES" imagen="{{ asset('images/cli_prov.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalNuevoCliProv').modal('show');">Nuevo
                        Cliente/Prov</x-button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tipo</th>
                                <th>Nombre</th>
                                <th>Fecha Antigüedad</th>
                                <th>Tramo Actual Comisión</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cli_prov as $c_p)
                                <tr>
                                    <td><x-nav-link href="/cli_prov/{{$c_p->id}}">
                                            {{ str_pad($c_p->id, 4, '0', STR_PAD_LEFT) }}
                                        </x-nav-link>
                                    </td>
                                    <td>{{$c_p->tipo}}</td>
                                    <td>{{$c_p->nombre}}</td>
                                    <td>
                                        @if($c_p->fecha_antiguedad != null)
                                            {{ \Carbon\Carbon::parse($c_p->fecha_antiguedad)->format('d/m/Y') }}
                                        @endif
                                    </td>
                                    <td>{{$c_p->tramo_actual_comision}}</td>
                                    <td>
                                        <x-danger-button type="button" onclick="eliminarFila('{{$c_p->id}}');">
                                            <i class="fa-solid fa-xmark fa-fade"></i>
                                        </x-danger-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoCliProv">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>CREAR NUEVO CLIENTE/PROVEEDOR</b></h4>
            </div>
            <form action='/cli_prov/create' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Tipo:</x-label>
                        <div class="col-sm-7">
                            <select name="tipo" class="form-control" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                <option value="CLIENTE">CLIENTE</option>
                                <option value="PROVEEDOR">PROVEEDOR</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Nombre:</x-label>
                        <div class="col-sm-7">
                            <x-input type="text" name="nombre" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Fecha Antigüedad:</x-label>
                        <div class="col-sm-7">
                            <x-input type="date" name="fecha_antiguedad" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Tramo Actual Comisión:</x-label>
                        <div class="col-sm-7">
                            <x-input type="text" name="tramo_actual_comision" class="form-control" value=""></x-input>
                        </div>
                    </div> -->
                </div>

                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Crear</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
    'metodo' => '/cli_prov/destroy',
    'texto' => '¿Estás seguro que quieres eliminar este registro?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function () {

        // Si los select2 que queremos estan dentro de un modal, deberemos poner esto
        $('select').select2({
            dropdownParent: $("#modalNuevoCliProv"),
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