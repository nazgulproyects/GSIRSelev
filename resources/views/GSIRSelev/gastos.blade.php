@extends('GSIRSelev.layout')

@section('title', 'GSIR - GASTOS')

@section('content')

<style>
  .boton_nuevo {
    background-color: #4CB8FF;
    border-radius: 10px;
    color: white;
    font-size: 20px;
    border: none;
    padding: 5px 10px;
  }
</style>

<!-- Navbar -->
<div class="navbar">
  <div class="left-section">
    <h1><b>GASTOS</b></h1>
  </div>
  <div class="right-section">
    <a href="/gsir_selev/principal_get"><i class="fa-solid fa-house-chimney fa-lg"></i></a>
    <a href=""><i class="fa-solid fa-rotate fa-xl"></i></a>
  </div>
</div>

<!-- Botón Añadir Gasto -->
<div class="row d-flex justify-content-center mb-3">

  <button type="button" class="boton_nuevo" data-toggle="modal" data-target="#gastoModal" style="padding: 4px; width: 100%; height: 100%; padding-top: 15px; padding-bottom: 15px;">
    <i class="fa-solid fa-plus fa-xl"></i><b>AÑADIR GASTO</b>
  </button>
</div>


<!-- Tabla de Todos los Gastos -->
<table id="todos-gastos" class="display table table-striped table-bordered" style="width:100%">
  <thead>

    <tr>
      <th>Fecha</th>
      <th>Tipo</th>
      <th>Cantidad</th>
    </tr>
  </thead>
  <tbody>
    @foreach($gastos as $gasto)
    <tr>
      <td>{{$gasto['fecha']}}</td>
      <td>{{$gasto['tipo']}}</td>
      <td>{{$gasto['coste']}} €</td>
    </tr>
    @endforeach
  </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="gastoModal" tabindex="-1" role="dialog" aria-labelledby="gastoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gastoModalLabel"><b>NUEVO GASTO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          @csrf
          <div class="form-group">
            <label>Tipo</label>
            <select name="tipo_gasto" class="form-control select2" style="width: 100%;">
              <option value="" disabled selected>Seleccionar tipo</option>
              <option value="COMBUSTIBLE">COMBUSTIBLE</option>
              <option value="DIETAS">DIETAS</option>
              <option value="HOSPEDAJE">HOSPEDAJE</option>
            </select>
          </div>
          <div class="form-group">
            <label>Coste (€)</label>
            <input type="number" step="0.01" class="form-control" name="coste">
          </div>


          <!-- Input para tomar foto del ticket con texto personalizado -->
          <div class="form-group">
            <label for="foto_ticket">Foto del Ticket</label>
            <input type="file" id="foto_ticket" name="foto_ticket" class="form-control-file d-none" accept="image/*" capture="camera">
            <button type="button" class="btn btn-secondary" id="customButton">HACER FOTO TICKET</button>
          </div>

          <!-- Vista previa de la imagen seleccionada centrada -->
          <div class="row d-flex justify-content-center">
            <div class="form-group">
              <img id="preview" src="#" alt="Vista previa" style="display: none; margin-top: 10px; width: 100px; height: auto;">
            </div>
          </div>

          <!-- Botón para enviar -->
          <div class="row d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">AÑADIR GASTO</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>



<!-- Inclusión de DataTables -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function() {

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

  });
</script>

<!-- Script para abrir el input file al pulsar el botón y mostrar la vista previa -->
<script>
  document.getElementById('customButton').addEventListener('click', function() {
    document.getElementById('foto_ticket').click();
  });

  // Función para mostrar la vista previa de la imagen
  document.getElementById('foto_ticket').addEventListener('change', function(event) {
    var reader = new FileReader();
    reader.onload = function() {
      var preview = document.getElementById('preview');
      preview.src = reader.result;
      preview.style.display = 'block'; // Mostrar la imagen
    };
    if (event.target.files[0]) {
      reader.readAsDataURL(event.target.files[0]); // Leer la imagen seleccionada
    }
  });
</script>

@endsection