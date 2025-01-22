<x-guest-layout>
  <x-authentication-card>
    <x-slot name="logo">
      <!-- <x-authentication-card-logo /> -->
      <img src="{{ asset('images/logo-selev-biogroup.png') }}" width="100">
    </x-slot>




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

    <x-validation-errors class="mb-4" />

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
      {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div>
        <x-label for="username" value="{{ __('Username') }}" />
        <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
      </div>

      <div class="mt-4">
        <x-label for="password" value="{{ __('Password') }}" />
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <x-button class="ms-4">INCIAR SESION</x-button>
      </div>
    </form>
  </x-authentication-card>
</x-guest-layout>