<x-guest-layout>
  <x-authentication-card>
    <x-slot name="logo">
      <!-- <x-authentication-card-logo /> -->
      <img src="{{ asset('images/logo_general.png') }}" width="100">
    </x-slot>

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
        <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required
          autofocus autocomplete="username" />
      </div>

      <div class="mt-4">
        <x-label for="password" value="{{ __('Password') }}" />
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
          autocomplete="current-password" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <x-button class="ms-4">INCIAR SESION</x-button>
      </div>
    </form>
  </x-authentication-card>
</x-guest-layout>