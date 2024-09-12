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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-flex justify-content-around">
                <x-button-link href="/vehiculos" class="custom-button"><i class="fa-solid fa-truck fa-2xl" style="margin-right: 10px;"></i>VEHÍCULOS</x-button-link>
                <x-button-link href="/empleados" class="custom-button"><i class="fa-solid fa-user fa-2xl" style="margin-right: 10px;"></i>EMPLEADOS</x-button-link>
                <x-button-link href="/contratos" class="custom-button"><i class="fa-solid fa-file-contract fa-2xl" style="margin-right: 10px;"></i>CONTRATOS</x-button-link>
            </div>
            <div class="d-flex justify-content-around mt-4">
                <x-button-link href="/productos" class="custom-button"><i class="fa-solid fa-box-open fa-2xl" style="margin-right: 10px;"></i>PRODUCTOS</x-button-link>
                <x-button-link href="/proveedores" class="custom-button"><i class="fa-solid fa-user-tag fa-2xl" style="margin-right: 10px;"></i>PROVEEDORES</x-button-link>
                <x-button-link href="/rutas2" class="custom-button"><i class="fa-solid fa-route fa-2xl" style="margin-right: 10px;"></i>RUTAS</x-button-link>
            </div>
            <div class="d-flex justify-content-around mt-4">
                <x-button-link href="/puntos_recogida" class="custom-button"><i class="fa-solid fa-location-dot fa-2xl" style="margin-right: 10px;"></i>PUNTOS RECOGIDA</x-button-link>
                <x-button-link href="/costes" class="custom-button"><i class="fa-solid fa-dollar-sign fa-2xl" style="margin-right: 10px;"></i>COSTES</x-button-link>
                <x-button-link href="/albaranes" class="custom-button"><i class="fa-solid fa-file-pen fa-2xl" style="margin-right: 10px;"></i>ALBARANES</x-button-link>
                <!-- <x-button-link href="/planificacion_rutas" style="background-color: green;">PLANIFICACIÓN RUTAS</x-button-link> -->
            </div>
            <div class="d-flex justify-content-around mt-4">
                <x-button-link href="/cli_prov" class="custom-button">(CLIENTES/PROVEEDORES)</x-button-link>
                <!-- <x-button-link href="/rutas" class="custom-button">(RUTAS - OLD)</x-button-link> -->
                <!-- <x-button-link href="/recogidas">RECOGIDAS</x-button-link> -->
                <!-- <x-button-link href="/app_conductor">APP CONDUCTOR</x-button-link> -->
                <!-- <x-button-link href="/calendario" style="background-color: darkcyan;">CALENDARIO</x-button-link> -->
            </div>
        </div>
    </div>
</x-app-layout>