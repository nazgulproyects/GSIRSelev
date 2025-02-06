@section('botones_barra_superior')
<a href="/gsir_selev/principal_get" style="background-color: white;" class="inline-flex items-center justify-center p-3 rounded-md text-gray-600 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
  <i class="fa-solid fa-chevron-left fa-xl ml-1 mr-1"></i>
</a>

<button style="background-color: white;" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 ml-2" onclick="location.reload()">
  <i class="fa-solid fa-rotate"></i>
</button>
@endsection

<x-app-layout>

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


  @section('titulo_cabecera', 'Planta')


  <div class="d-flex justify-content-center mt-2 mb-2">
    <b style="color: #79B329; font-size: 20px;">DESCARGAS PENDIENTES</b>
  </div>

  @foreach($pendientes_desc as $pend_desc)
  <div class="row" style="margin-right: 5px; margin-left: 5px;">
    <div class="col-12">
      <div class="product-card">
        <div>
          <span>Ruta:</span>
          <span style="color: black;">{{ $pend_desc->cod_ruta }}</span>
        </div>
        <div>
          <span>Fecha:</span>
          <span style="color: black;">{{ $pend_desc->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div>
          <span>Cond:</span>
          <span style="color: black;"></span>
        </div>
        <div>
          <span>Peso:</span>
          <span style="color: black;"> Kg</span>
        </div>
        <div>
          <span>Vehículo:</span>
          <span style="color: black;">{{ $pend_desc->cod_vehiculo }}</span>
        </div>
        <button class="btn btn-secondary" data-id="{{ $pend_desc->cod_ruta }}" onclick="confirmDownload(this, '{{ $pend_desc->cod_ruta }}')"><b>DESCARGAR</b></button>
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

    function confirmDownload(button, cod_ruta) {

      // Muestra la alerta de confirmación
      swal({
        title: "¿Seguro que quieres descargar esta ruta?",
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
          // Si el usuario confirma, envía la solicitud AJAX para descargar
          $.ajax({
            url: "/pendientes_descarga/descargar",
            type: "POST",
            dataType: 'json',
            async: false,
            data: {
              "_token": $("meta[name='csrf-token']").attr("content"),
              cod_ruta: cod_ruta
            },
            success: function(response) {

              swal("¡Éxito!", "La descarga se ha realizado correctamente.", "success");

              // Después de 2 segundos, recarga la página
              setTimeout(function() {
                location.reload(); // Recarga la página
              }, 2000); // 2000 ms = 2 segundos
            },
            error: function(xhr, status, error) {
              swal("Error", "Hubo un problema al descargar.", "error");
            }
          });
        }
      });
    }
  </script>

</x-app-layout>