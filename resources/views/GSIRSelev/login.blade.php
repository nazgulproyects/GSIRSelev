@extends('GSIRSelev.layout')

@section('title', 'GSIR - HOME')

@section('navbar-title', 'Acceder')

@section('content')

<div class="navbar">
  <div class="left-section">
    <h1>@yield('navbar-title', 'Mi App')</h1>
  </div>
  <div class="right-section">
    <!-- <button><i class="fa-solid fa-mobile-screen"></i></button> -->
    <a href=""><i class="fa-solid fa-rotate fa-xl"></i></a>
    <a href="/modulos"><i class="fa-solid fa-times fa-xl"></i></a>
  </div>
</div>

<div class="text-center mt-4">
  <img src="{{ asset('images/logo-selev-biogroup.png') }}" alt="Logo" style="max-width: 70%;">
</div>

<div class="d-flex justify-content-center align-items-center" style="min-height: 65vh;">
  <!-- Card centrada -->
  <div class="card shadow-lg" style="width: 20rem;">
    <div class="card-body">



      <form action="/gsir_selev/empresa" id="nuevo_parte_form" method="POST" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group row">
          <input type="text" name="nif" class="form-control" placeholder="NIF" value="" required>
        </div>
        <div class="form-group row">
          <input type="password" name="password" class="form-control" placeholder="Contraseña" value="" required>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-secondary" style="background-color: #79B329; width: 200px;">ENTRAR</button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection