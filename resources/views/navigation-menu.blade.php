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

                @yield('botones_barra_superior')

                
            </div>
        </div>
    </div>

</nav>