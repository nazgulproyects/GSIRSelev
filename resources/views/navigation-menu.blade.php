<nav x-data="{ open: false }" class="border-b" style="background-color: #79b329 !important;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center" style="color: white;">
                <b>@yield('titulo_cabecera')</b>
            </div>

            <!-- Botones a la derecha -->
            <div class="flex items-center ">
                <!-- Botón de Logout -->
                <form method="POST" action="{{ route('logout') }}" x-data class="m-0 p-0">
                    @csrf
                    <button type="submit" style="background-color: white;" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 mr-2">
                        <i class="fa-solid fa-user-xmark"></i>
                    </button>
                </form>

                <!-- Botón de Reload -->
                <button style="background-color: white;" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600" onclick="location.reload()">
                    <i class="fa-solid fa-rotate"></i>
                </button>
            </div>
        </div>
    </div>

</nav>