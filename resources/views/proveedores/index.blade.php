<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Proveedores</x-nav-link>
    @endsection

    <style>
        th,
        td {
            font-size: 12px;
        }

        table.dataTable td {
            white-space: nowrap;
        }

        table.dataTable tbody td {
            vertical-align: middle;
        }

        #table tbody th,
        #table tbody td {
            vertical-align: middle !important;
            padding: 0px;
        }

        #table.dataTable tbody tr:hover {
            white-space: nowrap;
        }
    </style>
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="PROVEEDORES" imagen="{{ asset('images/cli_prov.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalNuevoCliProv').modal('show');">
                        Nuevo Proveedor
                    </x-button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="table" class="display table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha Original Contrato</th>
                                <th>Fecha firma nuevo contrato</th>
                                <th>Fecha Vencimiento Contrato</th>
                                <th>Nombre Comercial</th>
                                <th>Nombre Fiscal</th>
                                <th>DNI/CIF</th>
                                <th>Dirección Recogida</th>
                                <th>Dirección Fiscal</th>
                                <th>Teléfono</th>
                                <th>Persona Contacto</th>
                                <th>Email</th>
                                <th>Localidad</th>
                                <th>CP</th>
                                <th>Provincia</th>
                                <th>Recogida</th>
                                <th>Tipo Filtro</th>
                                <th>Nº Filtros Tubular</th>
                                <th>Tubulares Finos</th>
                                <th>Nº Filtros Rejilla</th>
                                <th>Nº Bidones</th>
                                <th>Stock bidones</th>
                                <th>Frecuencia recogida</th>
                                <th>Próxima recogida</th>
                                <th>Horarios recogida/entrega bidones</th>
                                <th>Notas</th>
                                <th>Comercial</th>
                                <th>IBAN</th>
                                <th>Precio/Bidón (IVA incluido)</th>
                                <th>ID (VAUS)</th>
                                <th>Comentarios</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedores as $prov)
                                <tr>
                                    <td>{{$prov->id}}</td>
                                    <td>@if($prov->f_original_contrato != null && $prov->f_original_contrato != '0000-00-00') {{ \Carbon\Carbon::parse($prov->f_original_contrato)->format('d/m/Y') }} @endif</td>
                                    <td>@if($prov->f_firma_nuevo_contrato != null && $prov->f_firma_nuevo_contrato != '0000-00-00') {{ \Carbon\Carbon::parse($prov->f_firma_nuevo_contrato)->format('d/m/Y') }} @endif</td>
                                    <td>@if($prov->f_vencimiento_contrato != null && $prov->f_vencimiento_contrato != '0000-00-00') {{ \Carbon\Carbon::parse($prov->f_vencimiento_contrato)->format('d/m/Y') }} @endif</td>
                                    <td>{{$prov->nombre_comercial}}</td>
                                    <td>{{$prov->nombre_fiscal}}</td>
                                    <td>{{$prov->dni_cif}}</td>
                                    <td>{{$prov->dir_recogida}}</td>
                                    <td>{{$prov->dir_fiscal}}</td>
                                    <td>{{$prov->telefono}}</td>
                                    <td>{{$prov->persona_contacto}}</td>
                                    <td>{{$prov->email}}</td>
                                    <td>{{$prov->localidad}}</td>
                                    <td>{{$prov->cp}}</td>
                                    <td>{{$prov->provincia}}</td>
                                    <td>{{$prov->recogida}}</td>
                                    <td>{{$prov->tipo_filtro}}</td>
                                    <td>{{$prov->num_filtros_tubular}}</td>
                                    <td>{{$prov->tubulares_finos}}</td>
                                    <td>{{$prov->num_filtros_rejilla}}</td>
                                    <td>{{$prov->num_bidones}}</td>
                                    <td>{{$prov->stock_bidones}}</td>
                                    <td>{{$prov->frecuencia_recogida}}</td>
                                    <td>{{$prov->prox_recogida}}</td>
                                    <td>{{$prov->horarios_rec_ent_bidones}}</td>
                                    <td>{{$prov->notas}}</td>
                                    <td>{{$prov->comercial}}</td>
                                    <td>{{$prov->iban}}</td>
                                    <td>{{$prov->precio_bidon}}</td>
                                    <td>{{$prov->id_vaus}}</td>
                                    <td>{{$prov->comentarios}}</td>
                                    <td></td>
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
                        <x-label class="col-sm-5 col-form-label">Nombre:</x-label>
                        <div class="col-sm-7">
                            <x-input type="text" name="nombre" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
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
                    </div>
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
            dropdownParent: $("#modalNuevaRuta"),
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