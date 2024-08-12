<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>App Conductor</x-nav-link>
    @endsection

    <style>
        .timeline {
            list-style-type: none;
            padding: 0;
            position: relative;
        }

        .timeline-line {
            position: absolute;
            width: 2px;
            /* Ancho de la línea */
            height: calc(100% - 40px);
            /* Altura de la línea, ajustada para excluir el margen inferior del último elemento */
            border-left: 2px dashed #007bff;
            /* Línea punteada */
            left: 10px;
            /* Ajusta la posición izquierda de la línea según sea necesario */
            top: 20px;
            /* Ajusta la posición superior de la línea según sea necesario */
        }


        .timeline-item {
            position: relative;
            margin-bottom: 40px;
            /* Espacio entre los elementos de la línea del tiempo */
        }

        .timeline-content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .timeline-icon {
            position: absolute;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            top: 20px;
            left: 1px;
            z-index: 1;
        }

        .timeline-icon i {
            color: white;
        }

        .timeline-buttons {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 0;
            margin-right: 10px;
        }

        .timeline-buttons button {
            width: 100px;
            height: 70px;
            margin-left: 10px;
            font-size: 10px;
            font-weight: bold;
        }
    </style>

    <style>
        #canvas {
            border: 3px solid rgba(0, 0, 0, .5);
            touch-action: none;
        }

        #save {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 10px;
        }
    </style>

    <div class="mt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row d-flex mb-2">
                <div class="col-12 d-flex justify-content-start">
                    <x-main_title title="ESTADO RUTA {{ $ruta->nombre }}" imagen="{{ asset('images/punto_recogida.png') }}" />
                </div>
            </div>
            <div class="timeline">
                <div class="timeline-line"></div> <!-- Línea vertical fuera de los elementos de la línea del tiempo -->
                @foreach($puntos_ruta as $punto_ruta)
                <div class="timeline-item">
                    <div class="timeline-content" style="margin-left: 40px;">
                        <b>{{ $punto_ruta->punto_recogida->nombre }}</b>
                        <p>
                            Descripción de la parada 1.
                            <br>
                            {{ $punto_ruta->estado }}
                        </p>
                        <div class="timeline-buttons">
                            <button class="btn btn-success" onclick="rellenarAlbaran('{{$punto_ruta->id}}')">ALBARAN</button>
                            <button class="btn btn-danger">RECHAZADO</button>
                        </div>
                    </div>
                    @if($punto_ruta->estado == 'PENDIENTE')
                    <div class="timeline-icon" style="background-color: #aaaaaa;">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    @elseif($punto_ruta->estado == 'RECHAZADO')
                    <div class="timeline-icon" style="background-color: #EC7063;">
                        <i class="fa-solid fa-times"></i>
                    </div>
                    @elseif($punto_ruta->estado == 'RECOGIDO')
                    <div class="timeline-icon" style="background-color: #2ECC71;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalAlbaran">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>FIRMAR ALBARAN</b></h4>
            </div>
            <div class="modal-body">
                <h4>PRODUCTOS RECOGIDOS</h4>
                <table id="tabla_productos_pr" class="display">
                    <thead>
                        <tr>
                            <th>PRODUCTO</th>
                            <th>RECOGIDO</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <br>
                <br>
                <h4>FIRMA DEL ALBARAN</h4>
                <!-- CANVAS PARA REALIZAR LA FIRMA -->
                <div id="container">
                    <canvas id="canvas"></canvas>
                    <br>
                    <div class="row d-flex justify-content-center">
                        <input type="button" class="btn btn-primary" id="save" value="FIRMAR ALBARAN">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')

<script>
    var table;

    $(document).ready(function() {

        // Si los select2 que queremos estan dentro de un modal, deberemos poner esto
        $('select').select2({
            dropdownParent: $("#modalNuevoPuntoRecogida"),
        });

        table = $('#tabla_productos_pr').DataTable({
            responsive: false,
            autoWidth: false,
            'oLanguage': {
                'sSearch': 'Buscar:'
            },
            'scrollX': true,
            'order': [],
            'lengthMenu': [30],
            bInfo: false,
            bFilter: false,
            bPaginate: false,
            showNEntries: false,
            lengthChange: false,
            'language': {
                'paginate': {
                    'previous': 'Anterior',
                    'next': 'Siguiente'
                }
            }

        })

        // Establece un listener de eventos para los checkboxes
        $('#tabla_productos_pr').on('change', '.styled-checkbox', function() {
            // Obtén el índice del checkbox
            var index = $(this).attr('id').split('_')[1];
            // Obtén el estado de marcado del checkbox
            var isChecked = $(this).is(':checked');
            // Obtén la fila correspondiente al checkbox
            var row = $(this).closest('tr');
            // Cambia el color de fondo de la fila dependiendo del estado del checkbox
            if (isChecked) {
                row.css('background-color', '#ABEBC6'); // Fila verde si está marcado
            } else {
                row.css('background-color', '#F5B7B1'); // Fila roja si no está marcado
            }
        });
    })

    function rellenarAlbaran(ruta_pr_id) {

        // OBTENEMOS LA LISTA DE LOS PRODUCTOS QUE SE DEBERIAN DE HABER RECOGIDO PARA QUE EL CONDUCTOR CONFIRME LA RECEPCION
        $.ajax({
            url: "/app_conductor/productos_pr",
            type: "POST",
            dataType: 'json',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                ruta_pr_id: ruta_pr_id
            },
            success: function(data) {

                table = $('#tabla_productos_pr').DataTable();
                table.clear().draw();
                // Itera sobre los elementos de la lista
                data.forEach(function(element, index) {
                    var checkboxHTML = "<input type='checkbox' id='checkbox_" + index + "' class='styled-checkbox' checked>";
                    var rowNode = table.row.add([element['nombre'], checkboxHTML]).draw().node();
                    $(rowNode).css('background-color', '#ABEBC6');
                });

                table.draw();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        })


        $('#modalAlbaran').modal('show');
    }
</script>

<!-- SCRIPT DE LA FIRMA DEL ALBARAN -->
<script>
    $('#modalAlbaran').on('shown.bs.modal', function(e) {

        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');

        var container = document.getElementById('container');
        canvas.width = container.offsetWidth;
        canvas.height = 200;

        var mouse = {
            x: 0,
            y: 0
        };

        canvas.addEventListener('pointermove', function(e) {
            mouse.x = e.offsetX; // Usar offsetX para obtener la posición relativa al canvas
            mouse.y = e.offsetY;
        }, false);

        ctx.lineJoin = 'round';
        ctx.lineCap = 'round';
        ctx.strokeStyle = 'black';

        canvas.addEventListener('pointerdown', function(e) {
            mouse.x = e.offsetX; // Usar offsetX para obtener la posición relativa al canvas
            mouse.y = e.offsetY;
            ctx.beginPath();
            ctx.moveTo(mouse.x, mouse.y);
            canvas.addEventListener('pointermove', onPaint, false);
        }, false);

        canvas.addEventListener('pointerup', function() {
            canvas.removeEventListener('pointermove', onPaint, false);
        }, false);

        var onPaint = function(e) {
            ctx.lineTo(mouse.x, mouse.y);
            ctx.stroke();
        };

        document.getElementById('save').onclick = function() {

            var dataURL = document.getElementById("canvas").toDataURL('image/png');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/app_conductor/guardar_albaran',
                data: {
                    '_token': $('input[name=_token]').val(),
                    imgBase64: dataURL
                },
                success: function(response) {
                   console.log(response)

                },
                error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
            });

        };
    });
</script>