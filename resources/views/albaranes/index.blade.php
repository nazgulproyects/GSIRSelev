<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Albaranes</x-nav-link>
    @endsection

    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="ALBARANES" imagen="{{ asset('images/contratos.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalNuevoAlbaran').modal('show');">Nuevo Albarán</x-button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Poblacion</th>
                                <th>PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($albaranes as $albaran)
                            <tr>
                                <td><x-nav-link href="/albaranes/{{$albaran->id}}">ALB_{{ str_pad($albaran->id, 4, '0', STR_PAD_LEFT) }}</x-nav-link></td>
                                <td>@if($albaran->fecha != null) {{ \Carbon\Carbon::parse($albaran->fecha)->format('d/m/Y') }} @endif</td>
                                <td>{{ $albaran->cliente }}</td>
                                <td>{{ $albaran->poblacion }}</td>
                                <td><a href="/albaranes/pdf/{{$albaran->id}}" target="_blank"><i class="fa-solid fa-file-pdf" style="color: red;"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalNuevoAlbaran">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>CREAR NUEVO ALBARÁN</b></h4>
            </div>
            <form action='/albaranes/create' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Fecha:</x-label>
                        <div class="col-sm-7">
                            <x-input type="date" name="fecha" class="form-control" value=""></x-input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Cliente:</x-label>
                        <div class="col-sm-7">
                            <select name="cli_prov_id" class="form-control" style="width: 100%;">
                                <option disabled selected>Seleccionar</option>
                                @foreach($cli_provs as $cli_prov)
                                <option value="{{$cli_prov->id}}">{{$cli_prov->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Crear Albarán</x-button>
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
            dropdownParent: $("#modalNuevoAlbaran"),
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