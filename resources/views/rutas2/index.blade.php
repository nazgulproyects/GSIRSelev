<x-app-layout>
    @section('rutas')
    <x-nav-link href="{{ route('rutas2.index') }}"
        :active="request()->routeIs('rutas2.index')">Rutas</x-nav-link>
    @endsection

    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="RUTAS" imagen="{{ asset('images/rutas.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <x-button type="button" onclick="$('#modalImportarRutas').modal('show');">IMPORTAR RUTAS</x-button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th style="text-align: center;">INFO RUTA</th>
                                <th style="text-align: center;">Fecha</th>
                                <th>Trabajador</th>
                                <th>Núm. Puntos recogida</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resultado as $reg)
                            <tr>
                                <td style="text-align: center;"><a href="/rutanew_info/{{$reg['fecha']}}/{{$reg['trabajador']}}"><i class="fa-solid fa-circle-info fa-xl" style="color: #007fcd;"></i></a></td>
                                <td style="text-align: center;"><span style="display: none;">{{$reg['fecha']}}</span>{{ \Carbon\Carbon::parse($reg['fecha'])->format('d/m/Y') }}</td>
                                <td>{{$reg['trabajador']}}</td>
                                <td>{{$reg['total']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- MODAL PARA IMPORTAR EL EXCEL CON LAS RUTAS -->
<div class="modal" tabindex="-1" role="dialog" id="modalImportarRutas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>IMPORTAR RUTAS</b></h4>
            </div>
            <form action='/rutas2/importar_excel' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-5 col-form-label">Seleccionar archivo Excel:</x-label>
                        <div class="col-sm-7">
                            <x-input type="file" name="archivo" class="form-control" accept=".xlsx, .xls"></x-input>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button type="submit">IMPORTAR</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/rutas_destroy',
'texto' => '¿Estás seguro que quieres eliminar esta ruta?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function() {

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
            'order': [
                [
                    '1', 'desc'
                ]
            ],
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