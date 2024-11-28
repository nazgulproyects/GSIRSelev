<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Costes</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="COSTES" imagen="{{ asset('images/costes.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalNuevoCoste').modal('show');">Nuevo Coste</x-button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Valor</th>
                                <th>Aplicado a</th>
                                <th>Entidad_id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($costes as $coste)
                                <tr>
                                    <td>{{$coste->tipo}}</td>
                                    <td>
                                        @if($coste->fecha != null)
                                            {{ \Carbon\Carbon::parse($coste->fecha)->format('d/m/Y') }}
                                        @endif
                                    </td>
                                    <td>{{$coste->descripcion}}</td>
                                    <td>{{$coste->valor}} €</td>
                                    <td>{{$coste->aplicado_a}}</td>
                                    <td>
                                        @if($coste->aplicado_a == 'vehiculo')
                                            <x-nav-link href="/vehiculos/{{$coste->entidad_id}}">
                                                {{$coste->entidad_vehiculo->matricula}}
                                            </x-nav-link>
                                        @elseif($coste->aplicado_a == 'cliente')
                                            <x-nav-link href="/cli_prov/{{$coste->entidad_id}}">
                                                {{$coste->entidad_cliente->nombre}}
                                            </x-nav-link>
                                        @else
                                            -
                                        @endif
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

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoCoste">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>NUEVO COSTE</b></h4>
            </div>
            <form action='/costes/create' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Aplicado a:</x-label>
                        <div class="col-sm-9">
                            <select name="aplicado_a" class="form-control" onchange="cargarEntidades(this.value);"
                                style="width: 100%;">
                                <option disabled selected value>Seleccionar</option>
                                <option value="vehiculo">Vehículo</option>
                                <option value="cliente">Cliente</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Entidad:</x-label>
                        <div class="col-sm-9">
                            <select name="entidad_id" id="entidad_id" class="form-control" style="width: 100%;">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Tipo coste:</x-label>
                        <div class="col-sm-9">
                            <select name="tipo" class="form-control" style="width: 100%;">
                                <option disabled selected value>Seleccionar tipo</option>
                                <option value="COSTE1">COSTE1</option>
                                <option value="COSTE2">COSTE2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Fecha:</x-label>
                        <div class="col-sm-9">
                            <x-input type="date" name="fecha" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row row align-items-center">
                        <x-label class="col-sm-3 col-form-label">Valor:</x-label>
                        <div class="col-sm-7">
                            <x-input type="number" step="0.01" name="valor" class="form-control" value="" style="text-align: right;"></x-input>
                        </div>
                        <div class="col-sm-2 text-start">€</div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-3 col-form-label">Descripción:</x-label>
                        <div class="col-sm-9">
                            <x-textarea name="descripcion" class="form-control" rows="4"></x-textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Crear Coste</x-button>
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
    $(document).ready(function () {

        $('select').select2({
            dropdownParent: $("#modalNuevoCoste"),
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


    // Al cambiar el select de aplicado_a, cargamos los valores correspondientes
    function cargarEntidades(aplicado_a) {

        var select = $('#entidad_id');
        select.empty();

        $.ajax({
            url: "/costes/cargar_entidades",
            type: "POST",
            dataType: 'json',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                aplicado_a: aplicado_a
            },
            success: function (data) {
                updateSelect(data, aplicado_a, select);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        })
    }

    // Rellenar el select de entidad con los valores correspondientes
    function updateSelect(data, aplicado_a, select) {

        select.append($('<option>', {
            value: '',
            text: 'Seleccionar',
            disabled: true, // Opcional: Deshabilita esta opción para que no sea seleccionable
            selected: true // Hace que esta opción sea la seleccionada por defecto
        }));

        // Recorre los datos y añade opciones al select
        $.each(data, function (index, item) {
            if (aplicado_a == 'vehiculo') {
                select.append($('<option>', {
                    value: item.id, // O cualquier otro valor que desees usar como valor de opción
                    text: item.matricula // O cualquier otro texto que desees mostrar
                }));
            } else if (aplicado_a == 'cliente') {
                select.append($('<option>', {
                    value: item.id, // O cualquier otro valor que desees usar como valor de opción
                    text: item.nombre // O cualquier otro texto que desees mostrar
                }));
            }

        });
    }

</script>