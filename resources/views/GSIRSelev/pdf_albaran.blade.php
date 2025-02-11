<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Albarán</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 20px;
      background-color: #f4f4f4;
    }

    .albaran-container {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .albaran-header {
      border-bottom: 2px solid #007bff;
      margin-bottom: 20px;
      padding-bottom: 15px;
    }

    .albaran-header h1 {
      font-size: 28px;
      color: #007bff;
    }

    .albaran-header p {
      font-size: 14px;
      color: #333;
    }

    .albaran-details {
      margin-bottom: 30px;
    }

    .table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 8px;
    }

    .table th,
    .table td {
      padding: 10px;
      text-align: left;
      vertical-align: middle;
    }

    .table th {
      background-color: #007bff;
      color: #fff;
    }

    .table-bordered th,
    .table-bordered td {
      border: 1px solid #ddd;
    }

    .table tfoot {
      font-weight: bold;
      background-color: #f9f9f9;
    }

    .total {
      text-align: right;
    }

    /* Ajustes para la columna de descripción */
    .table td:nth-child(1) {
      max-width: 300px;
      /* Limita el ancho máximo de la columna de descripción */
      word-wrap: break-word;
      /* Divide las palabras largas */
      white-space: normal;
      /* Permite que el texto se divida en varias líneas */
    }
  </style>
</head>

<body>
  <div class="container albaran-container">
    <div class="row albaran-header">
      <div class="col-6">
        <h1>Albarán</h1>
        <p><strong>Empresa:</strong> Nombre del Negocio</p>
        <p><strong>Dirección:</strong> Calle Falsa 123, Ciudad</p>
        <p><strong>Teléfono:</strong> +34 600 123 456</p>
      </div>
      <div class="col-6 text-end">
        <p><strong>Fecha:</strong> 25/09/2024</p>
        <p><strong>Albarán Nº:</strong> 001234</p>
      </div>
    </div>

    <div class="row albaran-details">
      <div class="col-6">
        <p><strong>Cliente:</strong> Nombre del Cliente</p>
        <p><strong>Dirección:</strong> Calle Ejemplo 45, Ciudad</p>
        <p><strong>Teléfono:</strong> +34 600 654 321</p>
      </div>
      <div class="col-6 text-end">
        <p><strong>Forma de pago:</strong> Transferencia bancaria</p>
        <p><strong>Condiciones:</strong> Pago a 30 días</p>
      </div>
    </div>

    <img src="C:\xampp\htdocs\GSIRSelev\public\storage\firmas/ruta_{{$ruta_id}}/firma_cliente.png" alt="Firma" style="width: 200px; height: auto;">
    <img src="C:\xampp\htdocs\GSIRSelev\public\storage\firmas/ruta_{{$ruta_id}}/firma_conductor.png" alt="Firma" style="width: 200px; height: auto;">


    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 50%;">Descripción</th>
          <th style="width: 15%;">Cantidad</th>
          <th style="width: 15%;">Precio Unitario</th>
          <th style="width: 20%;">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Producto 1 </td>
          <td>2</td>
          <td>50,00 €</td>
          <td>100,00 €</td>
        </tr>
        <tr>
          <td>Producto 2</td>
          <td>1</td>
          <td>30,00 €</td>
          <td>30,00 €</td>
        </tr>
        <tr>
          <td>Producto 3</td>
          <td>5</td>
          <td>10,00 €</td>
          <td>50,00 €</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="text-end">Subtotal</td>
          <td>180,00 €</td>
        </tr>
        <tr>
          <td colspan="3" class="text-end">IVA (21%)</td>
          <td>37,80 €</td>
        </tr>
        <tr>
          <td colspan="3" class="text-end total">Total</td>
          <td class="total">217,80 €</td>
        </tr>
      </tfoot>
    </table>

    <div class="row mt-4">
      <div class="col-6">
        <p><strong>Observaciones:</strong></p>
        <p>Gracias por su compra. Si tiene alguna pregunta, no dude en contactarnos.</p>
      </div>
      <div class="col-6 text-end">
        <p><strong>Firma:</strong></p>
        <p>__________________________</p>
        <p>Firma del Cliente</p>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>