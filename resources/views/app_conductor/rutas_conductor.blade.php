<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>App Conductor</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="row d-flex mb-2">
                <div class="col-12 d-flex justify-content-start">
                    <x-main_title title="RUTAS PARA HOY: {{auth()->user()->name}} {{auth()->user()->surname}} {{ \Carbon\Carbon::now()->format('d/m/Y') }}" imagen="{{ asset('images/punto_recogida.png') }}" />
                </div>
                
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rutas_dia as $ruta)
                            <tr>
                                <td><x-nav-link href="/app_conductor/abrir_ruta/{{$ruta->id}}">ABRIR RUTA</x-nav-link></td>
                                <td>{{$ruta->nombre}}</td>
                                <td>@if($ruta->fecha != null) {{ \Carbon\Carbon::parse($ruta->fecha)->format('d/m/Y') }} @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



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