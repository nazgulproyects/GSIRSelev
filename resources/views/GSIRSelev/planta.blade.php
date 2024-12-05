@extends('GSIRSelev.layout')

@section('title', 'GSIR - PLANTA')

@section('content')

<style>
  .boton_select {
    background-color: #4CB8FF;
    border-radius: 10px;
    color: white;
    border: none;
    padding: 10px 10px;
  }

  /* Estilo para centrar el campo de búsqueda */
  .search-container {
    text-align: center;
    margin-bottom: 20px;
  }

  .search-container input {
    padding: 10px;
    font-size: 16px;
    width: 50%;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  td {
    vertical-align: middle;
  }

  .row {
    align-items: center;
  }

  /* Estilo para resaltar la fila seleccionada */
  .highlight {
    background-color: #d4edda !important;
  }

  /* Ocultar el botón en la fila seleccionada */
  .highlight .boton_select {
    display: none;
  }

  .product-card {
    display: flex;
    flex-direction: column;
    padding: 10px;
    background-color: #f1f1f1;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
    width: 100%;
    margin-bottom: 10px;
  }

  .product-card span {
    font-weight: bold;
    color: #666666;
  }
</style>

<!-- Navbar -->
<div class="navbar mb-3">
  <div class="left-section">
    <h1><b>PLANTA</b></h1>
  </div>
  <div class="right-section">
    <a href="/gsir_selev/principal_get"><i class="fa-solid fa-house-chimney fa-lg"></i></a>
    <a href=""><i class="fa-solid fa-rotate fa-xl"></i></a>
  </div>
</div>
<div class="row d-flex justify-content-center mb-2">
  <b style="color: #79B329; font-size: 20px;">DESCARGAS PENDIENTES</b>
</div>

@foreach($vehiculos_pend as $vehiculo_p)
<div class="row" style="margin-right: 5px; margin-left: 5px;">
  <div class="col-12">
    <div class="product-card">
      <div>
        <span>Ruta:</span>
        <span style="color: black;">{{$vehiculo_p['ruta']}}</span>
      </div>
      <div>
        <span>Fecha:</span>
        <span style="color: black;">{{$vehiculo_p['fecha']}}</span>
      </div>
      <div>
        <span>Cond:</span>
        <span style="color: black;">{{$vehiculo_p['cond']}}</span>
      </div>
      <div>
        <span>Peso:</span>
        <span style="color: black;">{{$vehiculo_p['peso']}} Kg</span>
      </div>
      <div>
        <span>Vehículo:</span>
        <span style="color: black;">{{$vehiculo_p['vehiculo']}}</span>
      </div>
      <button class="btn btn-secondary"><b>DESCARGAR</b></button>
    </div>
  </div>
</div>
@endforeach

<script>
  $(document).ready(function() {

    // Inicializar DataTable
    var table = $('#vehiculos_pend_tabla').DataTable({
      responsive: false,
      autoWidth: false,
      "oLanguage": {
        "sSearch": "Buscar:"
      },
      'scrollX': true,
      bFilter: true,
      bPaginate: false,
      bInfo: false,
      showNEntries: false,
      lengthChange: false,
      "order": [],
      "lengthMenu": [30],
      "language": {
        "lengthMenu": "Mostrando _MENU_ resultados por página",
        "zeroRecords": "",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "paginate": {
          "previous": "Anterior",
          "next": "Siguiente"
        },
        "emptyTable": ""
      }
    });


  });
</script>

@endsection