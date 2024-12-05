@extends('GSIRSelev.layout')

@section('title', 'GSIR - VEHÍCULOS')

@section('content')

<style>
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

  .list-container {
    padding-left: 10px;
    padding-right: 10px;
  }

  .list-item {
    display: flex;
    align-items: center;
    justify-content: space-between !important;
    padding: 10px 0;
    border-bottom: 1px solid #ccc;
  }

  .list-item:last-child {
    border-bottom: none;
  }

  .list-item i {
    color: #666666;
    margin-right: 10px;
  }

  .list-item span {
    color: #666666;
    font-size: 15px;
    margin-right: 10px;
  }

  .list-item b {
    font-size: 16px;
    font-weight: bold;
    margin-left: auto;
  }
</style>

<!-- Navbar -->
<div class="navbar mb-3">
  <div class="left-section">
    <h1><b>VEHÍCULOS</b></h1>
  </div>
  <div class="right-section">
    <a href="/gsir_selev/principal_get"><i class="fa-solid fa-house-chimney fa-lg"></i></a>
    <a href=""><i class="fa-solid fa-rotate fa-xl"></i></a>
  </div>
</div>

<!-- Tabla de Todos los Gastos -->
<table id="todos-gastos" class="display table table-striped table-bordered text-center" style="width:100%;">
  <thead>
    <tr>
      <th>Matrícula</th>
    </tr>
  </thead>
  <tbody>
    @foreach($vehiculos as $vehiculo)
    <tr onclick="showModal('{{ $vehiculo['matricula'] }}', 'infuuu')">
      <td>

        <div class="d-flex justify-content-center position-relative">
          <b style="font-size: 20px;">{{$vehiculo['matricula']}}</b>
          @if($vehiculo['matricula'] == '4125HRD')
          <i class="fa-solid fa-circle-exclamation fa-beat mr-4 fa-lg" style="margin-top: 14px !important; position: absolute; right: 0; color: #ff4747;"></i>
          @endif
        </div>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>


<!-- Modal para mostrar los datos del cliente -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel"><b>INFO VEHÍCULO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="list-item">
          <span>MATRÍCULA:</span>
          <b id="modal-matricula"></b>
        </div>
        <div class="list-item">
          <span>ITV:</span>
          <b>24/10/2025</b>
          <a href="#" class="btn btn-sm ml-2" style="background-color: #dcdcdc;"><i class="fa-regular fa-file-pdf fa-xl" style="color: #fc2b2b; margin-right: 0px;"></i></a>
        </div>
        <div class="list-item">
          <span>SEGURO:</span>
          <b>02/05/2025</b>
          <a href="#" class="btn btn-sm ml-2" style="background-color: #dcdcdc;"><i class="fa-regular fa-file-pdf fa-xl" style="color: #fc2b2b; margin-right: 0px;"></i></a>
        </div>
        <div class="list-item">
          <span>ADR:</span>
          <b>12/11/2025</b>
          <a href="#" class="btn btn-sm ml-2" style="background-color: #dcdcdc;"><i class="fa-regular fa-file-pdf fa-xl" style="color: #fc2b2b; margin-right: 0px;"></i></a>
        </div>
        <div class="list-item">
          <span>Observaciones:</span>
          <b></b>
        </div>
      </div>
    </div>
  </div>
</div>




<script>
  $(document).ready(function() {
    // Inicializar DataTable
    var table = $('#todos-gastos').DataTable({
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

    // Filtrar tabla cuando el usuario escriba en el input
    $('#search-matricula').on('keyup', function() {
      table.search(this.value).draw();
    });

  });

  function showModal(matricula, info) {
    document.getElementById('modal-matricula').innerText = matricula;
    var modal = new bootstrap.Modal(document.getElementById('infoModal'));
    modal.show();
  }
</script>

@endsection