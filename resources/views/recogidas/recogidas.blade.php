<x-app-layout>
    <div class="mt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row-3 d-flex justify-content-between mb-2">
                <x-main_title title="RECOGIDAS" />
                <x-button type="button" onclick="$('#modalNuevaRecogida').modal('show');">Nueva Recogida</x-button>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recogidas as $recogida)
                            <tr>
                                <td>{{$recogida->id}}</td>
                                <td>{{$recogida->nombre}}</td>
                                <td><x-danger-button type="button" onclick="eliminarFila('{{$recogida->id}}');"><i class="fa-solid fa-xmark"></i></x-danger-button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalNuevaRecogida">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>CREAR NUEVA RECOGIDA</b></h4>
            </div>
            <form action='/recogidas/create' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <x-label class="col-sm-4 col-form-label">Nombre:</x-label>
                        <div class="col-sm-8">
                            <x-input type="text" name="nombre" class="form-control" value=""></x-input>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Crear Recogida</x-button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- FUNCIONALIDAD ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/recogidas/destroy',
'texto' => '¿Estás seguro que quieres eliminar esta recogida?'
])

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    $(document).ready(function() {
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

