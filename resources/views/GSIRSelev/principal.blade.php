@section('botones_barra_superior')

<a href="/gsir_selev/empresa_back" style="background-color: white;" class="inline-flex items-center justify-center p-3 rounded-md text-gray-600 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
  <i class="fa-solid fa-chevron-left fa-xl ml-1 mr-1"></i>
</a>

<form method="POST" action="{{ route('logout') }}">
  @csrf
  <button type="submit" style="background-color: white;" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 ml-2">
    <i class="fa-solid fa-user-xmark"></i>
  </button>
</form>

@endsection

<x-app-layout>

  @section('titulo_cabecera', 'Home')


  <div class="row d-flex justify-content-center mt-4">
    @if(auth()->user()->empresa == 'SELEV')
    <img src="{{ asset('images/logo_selev.png') }}" alt="Logo" style="max-width: 70%;">
    @elseif(auth()->user()->empresa == 'REMITTEL')
    <img src="{{ asset('images/logo_remittel.png') }}" alt="Logo" style="max-width: 70%;">
    @else
    <img src="{{ asset('images/logo_selev.png') }}" alt="Logo" style="max-width: 70%;">
    @endif

  </div>

  <div style="display: flex; justify-content: center;">
    <div style="margin-top: 10%">
      <a href="/rutas" class="btn" style="background-color: #79B329; width: 300px; height: 60px; border-radius: 10px; color: white; display: flex; align-items: center; justify-content: flex-start; margin: 0; padding-left: 10px;">
        <div style="flex-shrink: 0;">
          <i class="fa-solid fa-route fa-xl"></i>
        </div>
        <div style="flex-grow: 1; text-align: center;">
          <b>RUTAS</b>
        </div>
      </a>
      <!-- <a href="/vehiculos" class="btn mt-4" style="background-color: #ffaa37; width: 300px; height: 60px; border-radius: 10px; color: white; display: flex; align-items: center; justify-content: flex-start; margin: 0; padding-left: 10px;">
        <div style="flex-shrink: 0;">
          <i class="fa-solid fa-truck fa-xl"></i>
        </div>
        <div style="flex-grow: 1; text-align: center;">
          <b>VEHÍCULOS</b>
        </div>
      </a> -->
      <a href="/pendientes_descarga" class="btn mt-4" style="background-color: #ff6969; width: 300px; height: 60px; border-radius: 10px; color: white; display: flex; align-items: center; justify-content: flex-start; margin: 0; padding-left: 10px; position: relative;">
        <div style="flex-shrink: 0;">
          <i class="fa-solid fa-industry fa-xl"></i>
        </div>
        <div style="flex-grow: 1; text-align: center;">
          <b>DESCARGAS PENDIENTES</b>
        </div>
        <!-- Contador de descargas pendientes -->
        @if($num_desc_pend > 0)
        <div id="pendientes-count" style="position: absolute; top: -10px; right: -10px; width: 30px; height: 30px; background-color: #ffffff; color: #ff6969; font-size: 14px; font-weight: bold; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
          <b>{{ $num_desc_pend }}</b>
        </div>
        @endif
      </a>

      <!-- <a href="/gsir_selev/gastos" class="btn mt-4" style="background-color: #4cb8ff; width: 300px; height: 60px; border-radius: 10px; color: white; display: flex; align-items: center; justify-content: flex-start; margin: 0; padding-left: 10px;">
        <div style="flex-shrink: 0;">
          <i class="fa-solid fa-gas-pump fa-xl"></i>
        </div>
        <div style="flex-grow: 1; text-align: center;">
          <b>GASOLINA / DIETAS</b>
        </div>
      </a> -->
    </div>
  </div>

</x-app-layout>