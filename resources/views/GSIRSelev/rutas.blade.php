@section('botones_barra_superior')
<a href="/gsir_selev/principal_get" style="background-color: white;" class="inline-flex items-center justify-center p-3 rounded-md text-gray-600 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
  <i class="fa-solid fa-chevron-left fa-xl ml-1 mr-1"></i>
</a>

<button style="background-color: white;" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 ml-2" onclick="location.reload()">
  <i class="fa-solid fa-rotate"></i>
</button>
@endsection

<x-app-layout>

  @section('titulo_cabecera', 'Rutas')

  <br>
  @foreach($rutas as $ruta)

  <div style="display: flex; justify-content: center;">
    <a href="/gsir_selev/ruta/123" class="btn mt-1 mb-1" style="background-color: #79B329; width: 350px; height: 60px; color: white; display: flex; align-items: center; justify-content: space-between; border-radius: 10px; margin: 0; padding-left: 10px; padding-right: 0; overflow: hidden;">
      <div style="flex-shrink: 0;">
        <i class="fa-solid fa-route fa-xl"></i>
      </div>
      <div style="flex-grow: 1; text-align: center;">
        <b>{{$ruta['nombre']}}:</b><span class="ml-2" style="color: #efefef;">{{$ruta['desc']}}</span>
      </div>

      {{-- Condicional para cambiar el color y el ícono basado en el estado --}}
      @if ($ruta['estado'] == 'COMPLETADO')
      <div style="width: 20%; background-color: #4cb8ff; display: flex; align-items: center; justify-content: center; height: 130%; border-radius: 0 10px 10px 0;">
        <i class="fa-solid fa-check fa-xl" style="color: white;"></i>
      </div>
      @elseif ($ruta['estado'] == 'PENDIENTE DESCARGA')
      <div style="width: 20%; background-color: #ffaa37; display: flex; align-items: center; justify-content: center; height: 130%; border-radius: 0 10px 10px 0;">
        <i class="fa-solid fa-spinner fa-spin fa-xl" style="color: white;"></i>
      </div>
      @elseif ($ruta['estado'] == 'PENDIENTE')
      <div style="width: 20%; background-color: #ff4c4c; display: flex; align-items: center; justify-content: center; height: 130%; border-radius: 0 10px 10px 0;">
        <i class="fa-solid fa-exclamation fa-xl" style="color: white;"></i>
      </div>
      @endif

    </a>
  </div>


  @endforeach

</x-app-layout>