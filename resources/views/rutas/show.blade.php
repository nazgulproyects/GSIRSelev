<x-app-layout>
    @section('rutas')
    <x-nav-link href="{{ route('rutas.index') }}" :active="request()->routeIs('rutas.index')">Rutas</x-nav-link>
    <x-nav-link href="#" active="true">{{$ruta->nombre}}</x-nav-link>
    @endsection

    <style>
        .container {}

        .list-item {
            position: absolute;
            top: 0;
            left: 0;
            height: 90px;
            width: 100%;
        }

        .item-content {
            height: 100%;
            border: 0px solid rgba(123, 123, 123, 0.498039);
            border-radius: 4px;
            color: rgb(153, 153, 153);
            line-height: 90px;
            padding-left: 32px;
            font-size: 24px;
            font-weight: 400;
            background-color: rgb(255, 255, 255);
            box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 2px 0px;
        }



        ul.timeline {
            list-style-type: none;
            position: relative;
        }

        ul.timeline:before {
            content: '';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }

        ul.timeline>li {
            margin: 70px 0;
            /* 70 margen de abajo, 45 margen de la derecha  */
            padding-left: 80px;
        }

        ul.timeline>li:before {
            content: '\2713';
            background: #fff;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 0;
            left: 5px;
            width: 50px;
            height: 50px;
            z-index: 400;
            text-align: center;
            line-height: 50px;
            color: #d4d9df;
            font-size: 24px;
            border: 2px solid #d4d9df;
        }

        ul.timeline>li.active:before {
            content: '\2713';
            background: #28a745;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 0;
            left: 5px;
            width: 50px;
            height: 50px;
            z-index: 400;
            text-align: center;
            line-height: 50px;
            color: #fff;
            font-size: 30px;
            border: 2px solid #28a745;
        }

        .base_check {
            background-color: #E7E7E7;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 20px;
            padding-left: 15px;
        }
    </style>

    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action='/rutas/update/{{$ruta->id}}' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row d-flex mb-2">
                    <div class="col-6 d-flex justify-content-start">
                        <x-main_title title="{{$ruta->nombre}}" imagen="{{ asset('images/rutas.png') }}" />
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <x-button type="submit">Guardar</x-button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Nombre:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="text" name="nombre" class="form-control" value="{{$ruta->nombre}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-3 col-form-label">Fecha:</x-label>
                                    <div class="col-sm-9">
                                        <x-input type="date" name="fecha" class="form-control" value="{{$ruta->fecha}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <x-label class="col-sm-4 col-form-label">Conductor:</x-label>
                                    <div class="col-sm-8">
                                        <select name="usuario_id" id="usuario_sel" class="form-control">
                                            @foreach($conductores as $conductor)
                                            <option value="{{$conductor->id}}">{{$conductor->name}} {{$conductor->surname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-4 col-form-label">Vehículo:</x-label>
                                    <div class="col-sm-8">
                                        <select name="vehiculo_id" id="vehiculo_sel" class="form-control">
                                            @foreach($vehiculos as $vehiculo)
                                            <option value="{{$vehiculo->id}}">{{$vehiculo->matricula}} - {{$vehiculo->nombre}} ({{$vehiculo->tipo}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-4 col-form-label">Empresa:</x-label>
                                    <div class="col-sm-8">
                                        <select name="empresa" id="empresa_sel" class="form-control">
                                            <option value="SELEV">SELEV</option>
                                            <option value="REMITTEL">REMITTEL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <x-label class="col-sm-5 col-form-label">Hora Inicio Propuesta:</x-label>
                                    <div class="col-sm-7">
                                        <x-input type="time" name="hora_inicio_prop" class="form-control" value="{{$ruta->hora_inicio_prop}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-5 col-form-label">Hora Fin Propuesta:</x-label>
                                    <div class="col-sm-7">
                                        <x-input type="time" name="hora_fin_prop" class="form-control" value="{{$ruta->hora_fin_prop}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-5 col-form-label">Km Inicio:</x-label>
                                    <div class="col-sm-7">
                                        <x-input type="number" name="km_inicio" class="form-control" value="{{$ruta->km_inicio}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-label class="col-sm-5 col-form-label">Km Fin:</x-label>
                                    <div class="col-sm-7">
                                        <x-input type="number" name="km_fin" class="form-control" value="{{$ruta->km_fin}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action='/rutas/valor_orden/{{$ruta->id}}' id="form_guardar_orden" method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row d-flex mb-4 mt-4">
                    <div class="col-4 d-flex justify-content-start">
                        <x-main_title title="PUNTOS RECOGIDA" imagen="{{ asset('images/punto_recogida.png') }}" />
                    </div>
                    <div class="col-8 d-flex justify-content-end">
                        <x-button type="button" onclick="abrirGoogleMapsConRuta();">
                            ABRIR RUTA EN GOOGLE MAPS
                            <img src="{{ asset('images/google_maps.png') }}" style="margin-left: 5px;" width="20">
                        </x-button>
                        <x-button type="button" onclick="$('#modalAsignarPuntoRecogida').modal('show');">
                            AÑADIR PUNTO RECOGIDA
                            <i class="fa-solid fa-plus fa-beat fa-xl" style="margin-left: 5px;"></i>
                        </x-button>
                    </div>
                </div>
                <!-- LISTA CON LOS PUNTOS DE RECOGIDA -->
                <div class="card mt-2">
                    <section class="container">
                        @foreach($rutas_puntos_recogida as $ruta_pr)
                        <div class="list-item">
                            <div class="item-content">
                                <div class="row-12 d-flex justify-content-between">
                                    <span class="order">{{$ruta_pr->orden}}</span>
                                    <input class="order" style="display: none;" name="orden_{{$ruta_pr->id}}" value="{{$ruta_pr->id}}"></input>
                                    <a href="/puntos_recogida">{{$ruta_pr->punto_recogida->nombre}} | ({{$ruta_pr->punto_recogida->NombreContrato}}) - {{$ruta_pr->punto_recogida->NombreCliProv}}</a>
                                    <x-danger-button type="button" onclick="eliminarFila('{{$ruta_pr->id}}');"><i class="fa-solid fa-xmark fa-fade fa-2xl"></i></x-danger-button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </section>
                </div>
            </form>


        </div>
    </div>
</x-app-layout>

<div class="modal" tabindex="-1" role="dialog" id="modalAsignarPuntoRecogida">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center"><b>AÑADIR PUNTO RECOGIDA</b></h4>
            </div>
            <form action='/rutas/asignar_punto_recogida/{{$ruta->id}}' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-group row mb-1">
                        <x-label class="col-sm-4 col-form-label">Punto de Recogida:</x-label>
                        <div class="col-sm-8">
                            <select name="punto_recogida_id" id="selec_modal" class="form-control" style="width: 100%;">
                                <option disabled selected value>Seleccionar</option>
                                @foreach($puntos_recogida as $pr)
                                <option value="{{$pr->id}}">{{$pr->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row-3 d-flex justify-content-end">
                        <x-button cla type="submit">Añadir Punto Recogida</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/rutas/rutas_pr_eliminar',
'texto' => '¿Estás seguro que quieres eliminar este punto de recogida de la ruta?'
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

        $('#usuario_sel').val('{{$ruta->usuario_id}}').change();
        $('#vehiculo_sel').val('{{$ruta->vehiculo_id}}').change();
        $('#empresa_sel').val('{{$ruta->empresa}}').change();

        $('#selec_modal').select2({
            dropdownParent: $("#modalAsignarPuntoRecogida"),
        });

    })

    // Función para abrir Google Maps con ruta en coche entre los puntos de recogida que tiene la ruta
    function abrirGoogleMapsConRuta() {

        $.ajax({
            url: "/rutas/coordenadas_pr",
            type: "POST",
            dataType: 'json',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                ruta: '{{$ruta->id}}'
            },
            success: function(data) {
                window.open(data, '_blank');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        })
    }
</script>


<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/Draggable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenLite.min.js" integrity="sha512-5nTpER5HrSoRPyd8szIn2QglL3A54KJs4XOcX3SdHTbLb8TO/5wLqoFYSFGNyhzZy7CFAOZf66X3ikr2v7Bfuw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- SCRIPT PARA LA LISTA ORDENABLE -->
<script>
    var rowSize = 100; // => container height / number of items
    var container = document.querySelector(".container");
    var listItems = Array.from(document.querySelectorAll(".list-item")); // Array of elements
    var sortables = listItems.map(Sortable); // Array of sortables
    var total = sortables.length;

    TweenLite.to(container, 0.5, {
        autoAlpha: 1
    });

    function changeIndex(item, to) {

        // Change position in array
        arrayMove(sortables, item.index, to);

        // Change element's position in DOM. Not always necessary. Just showing how.
        if (to === total - 1) {
            container.appendChild(item.element);
        } else {
            var i = item.index > to ? to : to + 1;
            container.insertBefore(item.element, container.children[i]);
        }

        // Set index for each sortable
        sortables.forEach((sortable, index) => sortable.setIndex(index));

        // Auto guardar aqui que es cuando se cambia de orden
        
        // Obtendo los datos del formulario que habia arriba
        var formData = {}; // En esta variable tendre lo mismo que en el $request del formulario

        // Itera sobre los elementos del formulario en el orden en que aparecen en el DOM
        $('#form_guardar_orden').find('input[name^="orden_"]').each(function() {
            var name = $(this).attr('name');
            var value = $(this).val();

            // Agrega el campo al objeto formData
            formData[name] = value;
        });


        var formDataValues = Object.values(formData);

        $.ajax({
            url: "/rutas/valor_orden/{{$ruta->id}}",
            type: "POST",
            dataType: 'json',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                formulario: formDataValues
            },
            success: function(data) {
                
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        })

    }

    function Sortable(element, index) {

        var content = element.querySelector(".item-content");
        var order = element.querySelector(".order");

        var animation = TweenLite.to(content, 0.3, {
            boxShadow: "rgba(0,0,0,0.2) 0px 16px 32px 0px",
            force3D: true,
            scale: 1.1,
            paused: true
        });

        var dragger = new Draggable(element, {
            onDragStart: downAction,
            onRelease: upAction,
            onDrag: dragAction,
            cursor: "inherit",
            type: "y"
        });

        // Public properties and methods
        var sortable = {
            dragger: dragger,
            element: element,
            index: index,
            setIndex: setIndex
        };

        TweenLite.set(element, {
            y: index * rowSize
        });

        function setIndex(index) {

            sortable.index = index;
            order.textContent = index + 1;

            // Don't layout if you're dragging
            if (!dragger.isDragging) layout();
        }

        function downAction() {
            animation.play();
            this.update();
        }

        function dragAction() {

            // Calculate the current index based on element's position
            var index = clamp(Math.round(this.y / rowSize), 0, total - 1);

            if (index !== sortable.index) {
                changeIndex(sortable, index);
            }
        }

        function upAction() {
            animation.reverse();
            layout();
        }

        function layout() {
            TweenLite.to(element, 0.3, {
                y: sortable.index * rowSize
            });
        }

        return sortable;
    }

    // Changes an elements's position in array
    function arrayMove(array, from, to) {
        array.splice(to, 0, array.splice(from, 1)[0]);
    }

    // Clamps a value to a min/max
    function clamp(value, a, b) {
        return value < a ? a : (value > b ? b : value);
    }
</script>