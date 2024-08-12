<x-app-layout>
    @section('rutas')
    <x-nav-link href="#" active>Calendario</x-nav-link>
    @endsection

    <div class="mt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row d-flex mb-2">
                <div class="col-6 d-flex justify-content-start">
                    <x-main_title title="CALENDARIO" imagen="{{ asset('images/cli_prov.png') }}" />
                </div>
                <div class="col-6 d-flex justify-content-end">

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    $(document).ready(function() {

        var esLocale = {
            code: 'es',
            week: {
                dow: 1, // Lunes es el primer día de la semana
                doy: 4 // La semana que contiene el 1 de Enero es la primera semana del año
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
                list: 'Lista'
            },
            allDayText: 'Todo el día',
            moreLinkText: 'más',
            noEventsText: 'No hay eventos para mostrar'
        };


        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridWeek', // Utiliza la vista dayGridWeek
            locale: esLocale,
            height: 600,
            eventOrder: 'orden',
            headerToolbar: {
                left: 'title',
                center: '',
                right: 'dayGridWeek,listWeek prev,next' // Botón para cambiar a la vista dayGridWeek
            },
            buttonText: {
                week: 'Semana',
                listWeek: 'Lista'
            },
            editable: true, // Permite arrastrar y soltar eventos
            events: {
                url: '/events', // URL que devuelve los eventos
                method: 'GET',
                failure: function() {
                    alert('Hubo un error al cargar los eventos!');
                }
            },
            eventMouseEnter: function(info) {
                info.el.style.cursor = 'pointer';
            },
            eventMouseLeave: function(info) {
                info.el.style.cursor = '';
            },
            eventClick: function(info) {

                var tipo = info.event.extendedProps.tipo;

                if (tipo === 'contrato') {
                    swal({
                        title: 'Crear una nueva ruta con este contrato',
                        text: '¿Quieres crear una nueva ruta a partir de este punto?',
                        icon: 'warning',
                        buttons: ['Cancelar', 'Aceptar']
                    }).then((result) => {
                        if (result) {
                            $.ajax({
                                url: "/crear_ruta",
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    "_token": $("meta[name='csrf-token']").attr("content"),
                                    contrato_id: info.event.id
                                },
                                success: function(data) {
                                    if (data == 'OK') {
                                        swal({
                                            position: 'center-center',
                                            icon: 'success',
                                            title: 'Ruta creada correctamente',
                                            showConfirmButton: false,
                                            buttons: false,
                                            timer: 2000
                                        });
                                        calendar.refetchEvents();
                                    } else {
                                        swal({
                                            position: 'center-center',
                                            icon: 'error',
                                            title: 'Error al crear la ruta',
                                            showConfirmButton: false,
                                            buttons: false,
                                            timer: 2000
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            })
                        }
                    });
                } else if (tipo === 'ruta') {
                    swal({
                        title: 'Ir a la ruta seleccionada',
                        text: '¿Quieres ir al ruta seleccionada?',
                        icon: 'warning',
                        buttons: ['Cancelar', 'Aceptar']
                    }).then((result) => {
                        if (result) {
                            var rutaId = info.event.id;
                            window.open('/rutas/' + rutaId);
                        }
                    });
                }

            }
        });

        calendar.render();

    })
</script>