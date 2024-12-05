<style>
  .custom-button {
    padding: 10px 20px;
    text-decoration: none;
    display: inline-block;
    border-radius: 5px;
    transition: background-color 0.5s ease, transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .custom-button:hover {
    background-color: #1f247f;
    /* Azul oscuro más claro */
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    background-image: linear-gradient(135deg, #1f247f, #1a1f71);
    /* Gradiente de azul oscuro */
  }

  .custom-button:active {
    background-color: #15195e;
    /* Azul oscuro más intenso */
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    background-image: linear-gradient(135deg, #15195e, #1f247f);
    /* Gradiente de azul oscuro */
  }
</style>
<x-app-layout>

  <div class="navbar">
    <div class="left-section">
      <h1>@yield('navbar-title', 'Mi App')</h1>
    </div>
    <div class="right-section">
      <a href="/modulos"><i class="fa-solid fa-right-from-bracket fa-xl"></i></a>
    </div>
  </div>

  <div class="text-center mt-4">
    <img src="{{ asset('images/logo-selev-biogroup.png') }}" alt="Logo" style="max-width: 70%;">
  </div>

  <div class="d-flex justify-content-center align-items-center" style="min-height: 65vh;">
    <!-- Card centrada -->


    <div class="card shadow-lg" style="width: 20rem;">

      <div class="card-body">



        <form action="/gsir_selev/principal" method="POST" enctype="multipart/form-data" class="form-horizontal">
          {{ csrf_field() }}
          <div class="form-group row">
            <div class="col-sm-8">
              <select name="empresa" class="form-control select2" style="width: 100%;" required>
                <option disabled selected>Seleccionar empresa</option>
                <option value="SELEV">SELEV</option>
                <option value="REMITTEL">REMITTEL</option>
              </select>
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-secondary" style="background-color: #79B329; width: 200px;">SELECCIONAR</button>
          </div>

        </form>

      </div>
    </div>
  </div>
  
</x-app-layout>