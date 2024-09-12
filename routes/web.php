<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/menu_principal', [App\Http\Controllers\GeneralController::class, 'menu_principal'])->name('menu_principal');

    // CONTRATOS
    Route::get('/contratos', [App\Http\Controllers\ContratosController::class, 'index'])->name('contratos.index');
    Route::post('/contratos/create', [App\Http\Controllers\ContratosController::class, 'create'])->name('contratos.create');
    Route::post('/contratos/destroy', [App\Http\Controllers\ContratosController::class, 'destroy'])->name('contratos.destroy');
    Route::get('/contratos/{id}', [App\Http\Controllers\ContratosController::class, 'show'])->name('contratos.show');
    Route::post('/contratos/asignar_prod_contrato/{contrato}', [App\Http\Controllers\ContratosController::class, 'asginarProd'])->name('contratos.asginarProd');
    Route::post('/contratos/eliminar_prod', [App\Http\Controllers\ContratosController::class, 'eliminar_prod'])->name('contratos.eliminar_prod');
    Route::post('/contratos/update/{id}', [App\Http\Controllers\ContratosController::class, 'update'])->name('contratos.update');
    Route::get('/contratos/pdf/{id}', [App\Http\Controllers\ContratosController::class, 'pdf'])->name('contratos.pdf');


    // CLIENTES/PROVEEDORES
    Route::get('/cli_prov', [App\Http\Controllers\CliProvController::class, 'index'])->name('cli_prov.index');
    Route::post('/cli_prov/create', [App\Http\Controllers\CliProvController::class, 'create'])->name('cli_prov.create');
    Route::get('/cli_prov/{id}', [App\Http\Controllers\CliProvController::class, 'show'])->name('cli_prov.show');
    Route::post('/cli_prov/update/{id}', [App\Http\Controllers\CliProvController::class, 'update'])->name('cli_prov.update');

    // PROVEEDORES
    Route::get('/proveedores', [App\Http\Controllers\ProveedoresController::class, 'index'])->name('proveedores.index');

    // ALBARANES
    Route::get('/albaranes', [App\Http\Controllers\AlbaranesController::class, 'index'])->name('albaranes.index');
    Route::post('/albaranes/create', [App\Http\Controllers\AlbaranesController::class, 'create'])->name('albaranes.create');
    Route::get('/albaranes/{id}', [App\Http\Controllers\AlbaranesController::class, 'show'])->name('albaranes.show');
    Route::post('/albaranes/asignar_prod_albaran/{albaran}', [App\Http\Controllers\AlbaranesController::class, 'asginarProd'])->name('albaranes.asginarProd');
    Route::get('/albaranes/pdf/{id}', [App\Http\Controllers\AlbaranesController::class, 'pdf'])->name('albaranes.pdf');


    // PRODUCTOS
    Route::get('/productos', [App\Http\Controllers\ProductosController::class, 'index'])->name('productos.index');
    Route::post('/productos/create', [App\Http\Controllers\ProductosController::class, 'create'])->name('productos.create');
    Route::post('/productos/destroy', [App\Http\Controllers\ProductosController::class, 'destroy'])->name('productos.destroy');
    Route::get('/productos/{id}', [App\Http\Controllers\ProductosController::class, 'show'])->name('productos.show');
    Route::post('/productos/update/{id}', [App\Http\Controllers\ProductosController::class, 'update'])->name('productos.update');


    // RECOGIDAS
    Route::get('/recogidas', [App\Http\Controllers\RecogidasController::class, 'index'])->name('recogidas.index');
    Route::post('/recogidas/create', [App\Http\Controllers\RecogidasController::class, 'create'])->name('recogidas.create');
    Route::post('/recogidas/destroy', [App\Http\Controllers\RecogidasController::class, 'destroy'])->name('recogidas.destroy');


    // VEHICULOS
    Route::get('/vehiculos', [App\Http\Controllers\VehiculosController::class, 'index'])->name('vehiculos.index');
    Route::post('/vehiculos/create', [App\Http\Controllers\VehiculosController::class, 'create'])->name('vehiculos.create');
    Route::post('/vehiculos/destroy', [App\Http\Controllers\VehiculosController::class, 'destroy'])->name('vehiculos.destroy');
    Route::get('/vehiculos/{id}', [App\Http\Controllers\VehiculosController::class, 'show'])->name('vehiculos.show');
    Route::post('/vehiculos/update/{id}', [App\Http\Controllers\VehiculosController::class, 'update'])->name('vehiculos.update');


    // COSTES
    Route::get('/costes', [App\Http\Controllers\CostesController::class, 'index'])->name('costes.index');
    Route::post('/costes/create', [App\Http\Controllers\CostesController::class, 'create'])->name('costes.create');
    Route::post('/costes/create_mant/{vehiculo}', [App\Http\Controllers\CostesController::class, 'create_mant'])->name('costes.create_mant');
    Route::post('/costes/cargar_entidades', [App\Http\Controllers\CostesController::class, 'cargar_entidades'])->name('costes.cargar_entidades');
    Route::post('/costes/destroy', [App\Http\Controllers\CostesController::class, 'destroy'])->name('costes.destroy');


    // EMPLEADOS
    Route::get('/empleados', [App\Http\Controllers\EmpleadosController::class, 'index'])->name('empleados.index');
    Route::post('/empleados/create', [App\Http\Controllers\EmpleadosController::class, 'create'])->name('empleados.create');
    Route::get('/empleados/{empleado}', [App\Http\Controllers\EmpleadosController::class, 'show'])->name('empleados.show');
    Route::post('/empleados/{empleado}', [App\Http\Controllers\EmpleadosController::class, 'update'])->name('empleados.update');
    Route::post('/empleados_destroy', [App\Http\Controllers\EmpleadosController::class, 'destroy'])->name('empleados.destroy');

    // PUNTOS RECOGIDA
    Route::get('/puntos_recogida', [App\Http\Controllers\PuntosRecogidaController::class, 'index'])->name('puntos_recogida.index');
    Route::post('/puntos_recogida/create', [App\Http\Controllers\PuntosRecogidaController::class, 'create'])->name('puntos_recogida.create');
    Route::post('/puntos_recogida_destroy', [App\Http\Controllers\PuntosRecogidaController::class, 'destroy'])->name('puntos_recogida.destroy');
    Route::get('/puntos_recogida/{id}', [App\Http\Controllers\PuntosRecogidaController::class, 'show'])->name('puntos_recogida.show');
    Route::post('/puntos_recogida/update/{id}', [App\Http\Controllers\PuntosRecogidaController::class, 'update'])->name('puntos_recogida.update');

    // RUTAS
    Route::get('/rutas2', [App\Http\Controllers\RutasController::class, 'rutas2'])->name('rutas2.index');
    Route::post('/rutas2/importar_excel', [App\Http\Controllers\RutasController::class, 'importarExcel'])->name('rutas2.create');

    // RUTAS
    Route::get('/rutas', [App\Http\Controllers\RutasController::class, 'index'])->name('rutas.index');
    Route::post('/rutas/create', [App\Http\Controllers\RutasController::class, 'create'])->name('rutas.create');
    Route::get('/rutas/{ruta}', [App\Http\Controllers\RutasController::class, 'show'])->name('rutas.show');
    Route::post('/rutas/update/{ruta}', [App\Http\Controllers\RutasController::class, 'update'])->name('rutas.update');
    Route::post('/rutas_destroy', [App\Http\Controllers\RutasController::class, 'destroy'])->name('rutas.destroy');

    Route::post('/rutas/valor_orden/{ruta_id}', [App\Http\Controllers\RutasController::class, 'valor_orden'])->name('rutas.valor_orden');

    Route::post('/rutas/asignar_punto_recogida/{ruta_id}', [App\Http\Controllers\RutasController::class, 'asignar_punto_recogida'])->name('rutas.asignar_punto_recogida');
    Route::post('/rutas/coordenadas_pr', [App\Http\Controllers\RutasController::class, 'coordenadas_pr'])->name('rutas.coordenadas_pr');
    Route::post('/rutas/rutas_pr_eliminar', [App\Http\Controllers\RutasController::class, 'rutas_pr_eliminar'])->name('rutas.rutas_pr_eliminar');

    // PLANIFICACION RUTAS
    Route::get('/planificacion_rutas', [App\Http\Controllers\PlanificacionRutasController::class, 'index'])->name('planificacion_rutas.index');

    // CALENDARIO
    Route::get('/calendario', [App\Http\Controllers\CalendarioController::class, 'index'])->name('calendario.index');
    Route::get('/events', [App\Http\Controllers\CalendarioController::class, 'getEvents'])->name('calendario.getEvents');
    Route::post('/crear_ruta', [App\Http\Controllers\CalendarioController::class, 'crear_ruta'])->name('calendario.crear_ruta');
    // APP CONDUCTOR
    Route::get('/app_conductor', [App\Http\Controllers\AppConductorController::class, 'index'])->name('app_conductor.index');
    Route::get('/app_conductor/abrir_ruta/{id}', [App\Http\Controllers\AppConductorController::class, 'show'])->name('app_conductor.show');
    Route::post('/app_conductor/productos_pr', [App\Http\Controllers\AppConductorController::class, 'productos_pr'])->name('app_conductor.productos_pr');
    Route::post('/app_conductor/guardar_albaran', [App\Http\Controllers\AppConductorController::class, 'guardar_albaran'])->name('app_conductor.guardar_albaran');
});
