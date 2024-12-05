@extends('GSIRSelev.layout')

@section('title', 'GSIR - EMPRESA')

@section('navbar-title', 'Acceder')

@section('content')

<div class="navbar">
  <div class="left-section">
    <h1>@yield('navbar-title', 'Mi App')</h1>
  </div>
  <div class="right-section">
    <a href="/modulos"><i class="fa-solid fa-user-xmark fa-lg"></i></a>
  </div>
</div>

<div class="text-center mt-4">

  @if(session('empresa') == 'SELEV')
  <img src="/storage/images/empresas/4/logo/RiZwuK4rMci6UBybEk2s5lHFIFLoJ7WFyM89nc7F.png" alt="Logo" style="max-width: 70%;">
  @elseif(session('empresa') == 'REMITTEL')
  <img src="/storage/images/empresas/10/logo/8JupoTJlkyIq7hUZfqn1fWGGA08pZyWBDjPJrfDe.png" alt="Logo" style="max-width: 70%;">
  @else
  <img src="/storage/images/empresas/4/logo/RiZwuK4rMci6UBybEk2s5lHFIFLoJ7WFyM89nc7F.png" alt="Logo" style="max-width: 70%;">
  @endif

</div>
<div style="display: flex; justify-content: center;">
  <div style="margin-top: 10%">
    <a href="/gsir_selev/rutas" class="btn" style="background-color: #79B329; width: 300px; height: 60px; border-radius: 10px; color: white; display: flex; align-items: center; justify-content: flex-start; margin: 0; padding-left: 10px;">
      <div style="flex-shrink: 0;">
        <i class="fa-solid fa-route fa-xl"></i>
      </div>
      <div style="flex-grow: 1; text-align: center;">
        <b>RUTAS</b>
      </div>
    </a>
    <a href="/gsir_selev/vehiculos" class="btn mt-4" style="background-color: #ffaa37; width: 300px; height: 60px; border-radius: 10px; color: white; display: flex; align-items: center; justify-content: flex-start; margin: 0; padding-left: 10px;">
      <div style="flex-shrink: 0;">
        <i class="fa-solid fa-truck fa-xl"></i>
      </div>
      <div style="flex-grow: 1; text-align: center;">
        <b>VEHÍCULOS</b>
      </div>
    </a>
    <a href="/gsir_selev/planta" class="btn mt-4" style="background-color: #ff6969; width: 300px; height: 60px; border-radius: 10px; color: white; display: flex; align-items: center; justify-content: flex-start; margin: 0; padding-left: 10px;">
      <div style="flex-shrink: 0;">
        <i class="fa-solid fa-industry fa-xl"></i>
      </div>
      <div style="flex-grow: 1; text-align: center;">
        <b>PLANTA</b>
      </div>
    </a>
    <a href="/gsir_selev/gastos" class="btn mt-4" style="background-color: #4cb8ff; width: 300px; height: 60px; border-radius: 10px; color: white; display: flex; align-items: center; justify-content: flex-start; margin: 0; padding-left: 10px;">
      <div style="flex-shrink: 0;">
        <i class="fa-solid fa-gas-pump fa-xl"></i>
      </div>
      <div style="flex-grow: 1; text-align: center;">
        <b>GASOLINA / DIETAS</b>
      </div>
    </a>
  </div>
</div>


@endsection