@section('botones_barra_superior')
<a href="/rutas" style="background-color: white;" class="inline-flex items-center justify-center p-3 rounded-md text-gray-600 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
  <i class="fa-solid fa-chevron-left fa-xl ml-1 mr-1"></i>
</a>

<button style="background-color: white;" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 ml-2" onclick="location.reload()">
  <i class="fa-solid fa-rotate"></i>
</button>
@endsection


<style>
  /* Estilo del input en estado de éxito */
  .form-control.success {
    border-color: #28a745;
    box-shadow: 0 0 5px #28a745;
  }

  .success-tick {
    position: absolute;
    top: 15px;
    /* Ajusta este valor para subir el tick */
    right: 20px;
    transform: translateY(-50%);
    font-size: 1.5rem;
    color: #28a745;
    animation: fadeIn 0.3s ease-in-out;
  }

  /* Ajusta la animación si es necesario */
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(-50%) scale(0.5);
    }

    to {
      opacity: 1;
      transform: translateY(-50%) scale(1);
    }
  }

  /* Estilo del input en estado de error */
  .form-control.error {
    border-color: #dc3545;
    box-shadow: 0 0 5px #dc3545;
  }

  .custom-checkbox {
    transform: scale(1.5);
    /* Ajusta el tamaño según tus necesidades */
    width: 20px;
    /* Opcional para ajustar el área de clic */
    height: 20px;
    /* Opcional para ajustar el área de clic */
    margin-right: 10px;
    /* Opcional para espacio con el label */
  }
</style>

<x-app-layout>
  @section('titulo_cabecera')
  {{ $cod_ruta }}
  @endsection

  @if($ruta_web->estado == 'COMPLETADO')
  <div class="button-container" style="text-align: center; margin-bottom: 1px;">
    <b style="width: 100%; background-color: #40c744; padding-top: 4px; padding-left: 10px; display: inline-block; color: white;">RUTA FINALIZADA</b>
  </div>
  @endif

  <div style="background-color: #c6c6c6; width: 100%; text-align: center; margin-bottom: 1px;">
  <button type="button" onclick="asociarVehiculo();" style="padding: 4px; width: 100%; height: 50px; background-color: #46ccff; border: none; cursor: pointer; display: flex; justify-content: center; align-items: center;">
  <div style="text-align: left; font-size: 1rem; line-height: 0.8; width: max-content;">
    <span style="display: block; margin-bottom: 2px;"><b>VEHÍCULO ASIGNADO: </b>{{ $cod_vehiculo }}</span>
  </div>
</button>



  </div>

  <div class="row text-center" style="background-color: #79B329;">
    <span style="color: white;">PUNTOS DE RECOGIDA</span>
  </div>

  <div style="display: flex; align-items: flex-start; position: relative; margin-top: 20px;">

    <div style="position: relative; width: 100%;">
      @foreach($puntos_recogida_agrup as $punto_recogida)
      <div style="display: flex; justify-content: center;">
        <div style="display: flex; align-items: center; margin-bottom: 15px;">

          <!-- Punto con ícono de estado -->
          <div style="height: 20px; width: 20px; z-index: 4; border-radius: 50%; background-color: {{ $punto_recogida->estado == 'PENDIENTE' ? '#ffaa37' : ($punto_recogida->estado == 'EN PROCESO' ? 'orange' : '#79B329') }}; margin-right: 10px; position: relative; display: flex; align-items: center; justify-content: center;">

            @if($punto_recogida->estado == 'PENDIENTE')
            <i class="fa-solid fa-xmark" style="color: white; font-size: 12px; z-index: 5;"></i>
            @elseif($punto_recogida->estado == 'FINALIZADO')
            <i class="fa-solid fa-check" style="color: white; font-size: 12px; z-index: 5;"></i>
            @endif
            <!-- Línea vertical -->
            <div style="position: absolute; left: 50%; top: 10px; width: 2px; height: calc(100% - 10px); background-color: {{ $punto_recogida->estado == 'PENDIENTE' ? '#ffaa37' : ($punto_recogida->estado == 'EN PROCESO' ? 'orange' : '#79B329') }};"></div>

          </div>

          <!-- Card como enlace -->
          <a href="/ruta/pto_recogida/{{ urlencode($ruta_nav->{'No_ ruta diaria'}) }}/{{ $punto_recogida->{'No_ Proveedor_Cliente'} }}" style="text-decoration: none;">
            <div class="card" style="width: 300px; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
              <!-- Encabezado con color según el estado -->
              <div class="card-header" style="background-color: {{ $punto_recogida->estado == 'PENDIENTE' ? '#ffaa37' : ($punto_recogida->estado == 'EN PROCESO' ? 'orange' : '#79B329') }}; color: white; display: flex; align-items: center; justify-content: space-between;">

                <div style="flex-shrink: 0; margin-right: 10px;">
                  <i class="fa-solid fa-location-dot fa-lg"></i>
                </div>
                <div style="flex-grow: 1; text-align: center;">
                  <b>{{ $punto_recogida->Nombre }}</b>
                </div>

              </div>
              <!-- Cuerpo blanco con la dirección -->
              <div class="card-body" style="background-color: white; padding: 15px;">
                <p style="margin: 0; color: #333;">{{ $punto_recogida->{'Direccion 1'} }}</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endforeach

      @if($ruta_web->estado != 'COMPLETADO')
      <div class="row d-flex justify-content-center pb-4" style="margin-left: 40px; margin-right: 40px;">
        <button class="btn btn-primary" onclick="finalizarRuta();"><b>FINALIZAR RUTA</b></button>
      </div>
      @endif

      <!-- Línea que une todos los puntos -->
      <div style="position: absolute; left: 39px; top: 60px; width: 2px; height: calc(100% - 200px); background-color: #0093ff;"></div>
    </div>
  </div>


  <!-- Modal asociar vehiculo -->
  <div class="modal fade" id="vehiculoModal" tabindex="-1" role="dialog" aria-labelledby="vehiculoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vehiculoModalLabel"><b>VEHÍCULO ASOCIADO</b></h5>
          <button type="button" class="btn-close" style="padding-bottom: 12px;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-4">
              <label>Vehículo</label>
            </div>
            <div class="col-8">
              <input type="text" class="form-control" name="vehiculo_ruta" value="{{ $cod_vehiculo }}" readonly id="vehiculoInput" style="cursor: pointer; background-color: #9be4ff !important;">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4">
              <label>Remolque 1</label>
            </div>
            <div class="col-8">
              <input type="text" class="form-control" name="remolque1_ruta" value="{{ $remolque_1 }}" readonly>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4">
              <label>Remolque 2</label>
            </div>
            <div class="col-8">
              <input type="text" class="form-control" name="remolque2_ruta" value="{{ $remolque_2 }}" readonly>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4">
              <label>Km iniciales</label>
            </div>
            <div class="col-8">
              <input type="text" class="form-control" name="km_iniciales" value="{{ $kms_iniciales }}" readonly>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para finalizar la ruta -->
  <div class="modal fade" id="finalizarDescarga" tabindex="-1" role="dialog" aria-labelledby="finalizarDescargaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="finalizarDescargaLabel"><b>FINALIZAR RUTA</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/ruta/finalizar/{{ rawurlencode($ruta_nav->{'No_ ruta diaria'}) }}" id="form_finalizar_ruta" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
              <label>Fecha de Fin</label>
              <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin">
            </div>
            <br>
            <div class="form-group">
              <label>Kms. Finales</label>
              <input type="number" step="1" class="form-control" name="km_finales">
            </div>
            <br>
            <!-- Checkbox para dejar pendiente de descarga -->
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input custom-checkbox" id="dejar_pendiente_descarga" name="dejar_pendiente_descarga">
              <label class="form-check-label" for="dejar_pendiente_descarga" style="color: red;">Dejar pendiente de descarga</label>
            </div>
            <br>
            <!-- Botón para enviar -->
            <div class="row d-flex justify-content-center">
              <button type="button" class="btn" onclick="finalizarRutaForm();" style="background-color: #28a745; color: white;"><b>FINALIZAR</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal cambiar vehiculo -->
  <div class="modal fade" id="cambioVehiculo" tabindex="-1" aria-labelledby="vehiculoModalLabel" aria-hidden="true" style="z-index: 1055;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vehiculoModalLabel">Cambio vehículo asociado a la ruta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/ruta/cambiar_vehiculo/{{$ruta_web->id}}" method="POST">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="matricula_anterior_val" id="matricula_anterior_val" value="{{ $cod_vehiculo }}">
            <div class="row">
              <div class="col-5">
                <label>Nuevo vehículo</label>
              </div>
              <div class="col-7 position-relative">
                <input type="text" class="form-control" id="matriculaInput" name="matricula_nuevo_vehiculo" value="" placeholder="Ingrese matrícula" autocomplete="off">
                <small id="matriculaFeedback" class="text-muted"></small>
                <!-- Tick de éxito -->
                <div id="successTick" class="success-tick" style="display: none;">
                  <i class="fa-solid fa-check"></i>
                </div>
              </div>
            </div>
            <br>
            <hr>
            <br>
            <div class="row">
              <div class="col-7">
                <label>Km finales <span id="km_finales_anterior"></span>:</label>
              </div>
              <div class="col-5">
                <input type="text" class="form-control" name="km_finales_input" id="km_finales_input" value="" readonly>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-7">
                <label>Km iniciales <span id="km_iniciales_nuevo"></span>:</label>
              </div>
              <div class="col-5">
                <input type="text" class="form-control" name="km_iniciales_input" id="km_iniciales_input" value="" readonly>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" style="background-color: #c1c1c1;" data-bs-dismiss="modal"><b>Cerrar</b></button>
            <button type="submit" class="btn" style="background-color: #1de167;" id="guardarVehiculo"><b>Guardar cambios</b></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('select').select2({
        dropdownParent: $("#vehiculoModal"),
      });

      $('#codigo_vehiculo').val('{{$cod_vehiculo}}').change();

    });

    document.getElementById('vehiculoInput').addEventListener('click', function() {
      $('#vehiculoModal').modal('hide');

      $('#km_finales_anterior').text('{{ $cod_vehiculo }}');

      var vehiculoModal = new bootstrap.Modal(document.getElementById('cambioVehiculo'));
      vehiculoModal.show();
    });


    function asociarVehiculo() {
      $('#vehiculoModal').modal('show');
    }

    function finalizarRuta() {
      var fechaActual = new Date();
      var year = fechaActual.getFullYear();
      var month = ('0' + (fechaActual.getMonth() + 1)).slice(-2);
      var day = ('0' + fechaActual.getDate()).slice(-2);
      var hours = ('0' + fechaActual.getHours()).slice(-2);
      var minutes = ('0' + fechaActual.getMinutes()).slice(-2);
      var fecha = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
      document.getElementById('fecha_fin').value = fecha;

      $('#finalizarDescarga').modal('show');
    }

    function finalizarRutaForm() {
      swal({
        title: "¿Seguro que quieres finalizar la ruta?",
        icon: "warning",
        buttons: {
          cancel: {
            text: "Cancelar",
            value: false,
            visible: true,
            className: "btn btn-danger",
            closeModal: true,
          },
          confirm: {
            text: "Confirmar",
            value: true,
            visible: true,
            className: "btn btn-success",
            closeModal: true,
          }
        },
        dangerMode: true
      }).then((willSubmit) => {
        if (willSubmit) {
          // Si el usuario confirma, se hace el submit del formulario
          $('#form_finalizar_ruta').submit();
        }
      });
    }
  </script>


  <script>
    document.getElementById('matriculaInput').addEventListener('keyup', function() {
      const matricula = this.value.trim();
      const feedback = document.getElementById('matriculaFeedback');
      const input = this;
      const tick = document.getElementById('successTick');

      // Mostrar un mensaje vacío si el campo está vacío
      if (matricula === '') {
        feedback.innerText = '';
        input.classList.remove('success', 'error');
        tick.style.display = 'none';
        return;
      }


      $.ajax({
        url: "/ruta/cambio_vehiculo_comprobar_matricula",
        type: "POST",
        dataType: 'json',
        async: false,
        data: {
          "_token": $("meta[name='csrf-token']").attr("content"),
          matricula: matricula
        },
        success: function(data) {

          console.log(data)
          const feedback = document.getElementById('matriculaFeedback');
          if (data) {
            // Estilo de éxito
            feedback.innerText = 'Matrícula correcta.';
            feedback.classList.remove('text-muted', 'text-danger');
            feedback.classList.add('text-success');
            input.classList.remove('error');
            input.classList.add('success');
            tick.style.display = 'block'; // Mostrar el tick


            $('#km_iniciales_nuevo').text(matricula);
            document.getElementById('km_iniciales_input').removeAttribute('readonly');
            document.getElementById('km_finales_input').removeAttribute('readonly');

          } else {
            // Estilo de error
            feedback.innerText = 'La matrícula no está registrada.';
            feedback.classList.remove('text-muted', 'text-success');
            feedback.classList.add('text-danger');
            input.classList.remove('success');
            input.classList.add('error');
            tick.style.display = 'none'; // Ocultar el tick
          }




        }
      });



    });
  </script>

</x-app-layout>