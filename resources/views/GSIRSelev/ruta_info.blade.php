<x-app-layout>

  @section('titulo_cabecera', 'RDR22/000766')

  <div style="background-color: #c6c6c6; width: 100%; text-align: center;">
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#vehiculoModal" style="padding: 4px; width: 100%; height: 100%; padding-top: 15px; padding-bottom: 15px;">
      <i class="fa-solid fa-truck-droplet fa-xl"></i> <b>PENDIENTE ASOCIAR VEHÍCULO</b>
    </button>
  </div>


  <div style="display: flex; align-items: flex-start; position: relative; margin-top: 20px;">

    <div style="position: relative; width: 100%;">
      @foreach($puntos_recogida as $punto_recogida)
      <div style="display: flex; justify-content: center;">
        <div style="display: flex; align-items: center; margin-bottom: 15px;">

          <!-- Punto con ícono de estado -->
          <div style="height: 20px; width: 20px; z-index: 4; border-radius: 50%; background-color: {{ $punto_recogida['estado'] == 'PENDIENTE' ? 'red' : ($punto_recogida['estado'] == 'EN PROCESO' ? 'orange' : '#79B329') }}; margin-right: 10px; position: relative; display: flex; align-items: center; justify-content: center;">
            @if($punto_recogida['estado'] == 'PENDIENTE')
            <i class="fa-solid fa-xmark" style="color: white; font-size: 12px; z-index: 5;"></i>
            @elseif($punto_recogida['estado'] == 'COMPLETADO')
            <i class="fa-solid fa-check" style="color: white; font-size: 12px; z-index: 5;"></i>
            @elseif($punto_recogida['estado'] == 'EN PROCESO')
            <i class="fa-solid fa-spinner fa-spin" style="color: white; font-size: 12px; z-index: 5;"></i>
            @endif
            <!-- Línea vertical -->
            <div style="position: absolute; left: 50%; top: 10px; width: 2px; height: calc(100% - 10px); background-color: {{ $punto_recogida['estado'] == 'PENDIENTE' ? 'red' : ($punto_recogida['estado'] == 'EN PROCESO' ? 'orange' : '#79B329') }};"></div>
          </div>

          <!-- Card como enlace -->
          <a href="/gsir_selev/ruta/pto_recogida/{{ $punto_recogida['id'] }}" style="text-decoration: none;">
            <div class="card" style="width: 300px; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
              <!-- Encabezado con color según el estado -->
              <div class="card-header" style="background-color: {{ $punto_recogida['estado'] == 'PENDIENTE' ? 'red' : ($punto_recogida['estado'] == 'EN PROCESO' ? 'orange' : '#79B329') }}; color: white; display: flex; align-items: center; justify-content: space-between;">
                <div style="flex-shrink: 0; margin-right: 10px;">
                  <i class="fa-solid fa-location-dot fa-lg"></i>
                </div>
                <div style="flex-grow: 1; text-align: center;">
                  <b>{{$punto_recogida['nombre']}}</b>
                </div>
                <!-- Texto con fondo -->
                <div style="color: white; border-radius: 5px; padding: 5px 10px; margin-left: 10px;">
                  <b>{{$punto_recogida['estado']}}</b>
                </div>
              </div>
              <!-- Cuerpo blanco con la dirección -->
              <div class="card-body" style="background-color: white; padding: 15px;">
                <p style="margin: 0; color: #333;">
                  {{$punto_recogida['direccion']}}
                </p>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endforeach
      <div class="row d-flex justify-content-center">
        <button class="btn btn-primary" onclick="finalizarRuta();"><b>FINALIZAR RUTA</b></button>
      </div>

      <!-- Línea que une todos los puntos -->
      <!-- <div style="position: absolute; left: 38px; top: 0; width: 4px; height: calc(100% - 20px); background-color: #0093ff;"></div> -->
    </div>
  </div>


  <script>
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
  </script>

  <!-- Modal -->
  <div class="modal fade" id="vehiculoModal" tabindex="-1" role="dialog" aria-labelledby="vehiculoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vehiculoModalLabel"><b>VEHÍCULO ASOCIADO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="#" method="POST">
            @csrf
            <div class="form-group">
              <label>Vehículo</label>
              <select name="codigo_ubicacion" class="form-control select2" style="width: 100%;">
                <option value="" disabled selected>Seleccionar vehículo</option>
                @foreach($vehiculos as $vehiculo)
                <option value="{{$vehiculo}}">{{$vehiculo}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Primer remolque</label>
              <select name="codigo_ubicacion" class="form-control select2" style="width: 100%;">
                <option value="" disabled selected>Seleccionar primer remolque</option>
                @foreach($vehiculos as $vehiculo)
                <option value="{{$vehiculo}}">{{$vehiculo}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Segundo remolque</label>
              <select name="codigo_ubicacion" class="form-control select2" style="width: 100%;">
                <option value="" disabled selected>Seleccionar segundo remolque</option>
                @foreach($vehiculos as $vehiculo)
                <option value="{{$vehiculo}}">{{$vehiculo}}</option>
                @endforeach
              </select>
            </div>
            <!-- Input -->
            <div class="form-group">
              <label>Km iniciales</label>
              <input type="number" step="1" class="form-control" name="km_iniciales">
            </div>

            <!-- Botón para enviar -->
            <div class="row d-flex justify-content-center">
              <button type="submit" class="btn btn-primary">Asociar Vehículo</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="finalizarDescarga" tabindex="-1" role="dialog" aria-labelledby="finalizarDescargaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="finalizarDescargaLabel"><b>DESCARGA</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="#" method="POST">
            @csrf
            <div class="form-group">
              <label>Código de ruta</label>
              <select name="codigo_ruta" class="form-control select2" style="width: 100%;">
                <option value="RDR22/000766">RDR22/000766</option>
              </select>
            </div>
            <div class="form-group">
              <label for="fecha_fin">Fecha de Fin</label>
              <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin">
            </div>
            <div class="form-group">
              <label for="fecha_fin">Kms. Finales</label>
              <input type="number" step="1" class="form-control" name="kms_finales">
            </div>
            <!-- Checkbox para dejar pendiente de descarga -->
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="dejar_pendiente_descarga" name="dejar_pendiente_descarga">
              <label class="form-check-label" for="dejar_pendiente_descarga">Dejar pendiente de descarga</label>
            </div>
            <!-- Botón para enviar -->
            <div class="row d-flex justify-content-center">
              <button type="submit" class="btn btn-primary">FINALIZAR</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>