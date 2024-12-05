<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  <!-- con este include hacemos referencia a los estilos, links de la web -->
  @include('complementos.estilos')

  @yield('styles')

  <!-- con este include hacemos referencia a los adornos en la parte de arriba de la web -->

  <style>
    /* Estilos básicos para simular una app móvil */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      height: 100vh;
      background-color: #f7f7f7;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      padding: 10px 20px;
      background-color: #79B329;
      color: white;
    }

    .navbar .left-section {
      display: flex;
      align-items: center;
    }

    .navbar .left-section h1 {
      margin: 0;
      font-size: 18px;
    }

    .navbar .right-section {
      display: flex;
      gap: 10px;
    }

    .navbar button {
      background-color: #5C6562;
      color: white;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      border-radius: 10px;
      /* Valor alto para bordes redondeados */
    }

    .navbar a {
      background-color: #5C6562;
      color: white;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      border-radius: 10px;
      /* Valor alto para bordes redondeados */
    }


    .content {
      flex-grow: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
    }
  </style>
</head>

<body>

  <script src="https://cdn.lordicon.com/lordicon.js"></script>
  <!-- Inclusión de jQuery y DataTables -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Añade jQuery -->
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

  <!-- Contenido dinámico -->
  @yield('content')

  @yield('scripts')


</body>

</html>