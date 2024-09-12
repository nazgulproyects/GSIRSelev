<x-app-layout>
  @section('rutas')
  <x-nav-link href="{{ route('rutas2.index') }}"
    :active="request()->routeIs('rutas2.index')">Rutas</x-nav-link>
  <x-nav-link href="#" active="true">{{ \Carbon\Carbon::parse($fecha)->format( 'd/m/Y') }} - {{$trabajador}}</x-nav-link>
  @endsection

  <style>
    table {
      /* Para mantener las celdas en una sola línea */
      width: 100%;
      /* Asegúrate de que la tabla use todo el ancho disponible */
    }

    th,
    td {
      white-space: nowrap;
      /* Evita saltos de línea */
      /* Oculta el texto que se desborda */
      /* Alineación del texto */
    }
  </style>


  <div class="mt-2">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
      <div class="row d-flex mb-2">
        <div class="col-6 d-flex justify-content-start">
          <x-main_title title="INFO RUTA" imagen="{{ asset('images/rutas.png') }}" />
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <table id="table" class="display">
            <thead>
              <tr>
                <th>Fecha retirada</th>
                <th>Proveedor</th>
                <th>CIF</th>
                <th>Email</th>
                <th>Población</th>
                <th>Provincia/País</th>
                <th>Trabajador</th>
                <th>Tipo</th>
                <th>Grupo</th>
                <th>Bidones</th>
                <th>Garrafas</th>
                <th>Litros</th>
                <th>Kilos</th>
                <th>Total kilos</th>
                <th>Residuo</th>
                <th>Importe</th>
                <th>Forma Pago</th>
                <th>Suministro</th>
                <th>Depósito</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($puntos_ruta as $punto)
              <tr>
                <td>{{ \Carbon\Carbon::parse($punto->fecha_retirada)->format( 'd/m/Y H:i') }}</td>
                <td>{{$punto->proveedor}}</td>
                <td>{{$punto->cif}}</td>
                <td>{{$punto->email}}</td>
                <td>{{$punto->poblacion}}</td>
                <td>{{$punto->provincia_pais}}</td>
                <td>{{$punto->trabajador}}</td>
                <td>{{$punto->tipo}}</td>
                <td>{{$punto->grupo}}</td>
                <td style="text-align: right;">{{$punto->bidones}}</td>
                <td style="text-align: right;">{{$punto->garrafas}}</td>
                <td style="text-align: right;">{{$punto->litros}}</td>
                <td style="text-align: right;">{{$punto->kilos}}</td>
                <td style="text-align: right;">{{$punto->total_kilos}}</td>
                <td>{{$punto->residuo}}</td>
                <td>{{$punto->importe}}</td>
                <td>{{$punto->forma_pago}}</td>
                <td>{{$punto->suministro}}</td>
                <td>{{$punto->deposito}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>


<!-- MODAL ELIMINAR FILA -->
@include('utils.notificaciones.eliminar_fila', [
'metodo' => '/rutas_destroy',
'texto' => '¿Estás seguro que quieres eliminar esta ruta?'
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