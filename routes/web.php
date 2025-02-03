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


  //==============================
  //====      GSIR SELEV       ====
  //==============================
  Route::group([], function () {
    Route::get('/gsir_selev', [App\Http\Controllers\GSIRSelev\GsirController::class, 'gsir_selev'])->name('gsir_selev.home');
    Route::post('/gsir_selev/empresa', [App\Http\Controllers\GSIRSelev\GsirController::class, 'empresa'])->name('gsir_selev.empresa');
    Route::get('/gsir_selev/empresa_back', [App\Http\Controllers\GSIRSelev\GsirController::class, 'empresa_back'])->name('gsir_selev.empresa_back');
    Route::post('/gsir_selev/principal', [App\Http\Controllers\GSIRSelev\GsirController::class, 'principal'])->name('gsir_selev.principal');
    Route::get('/gsir_selev/principal_get', [App\Http\Controllers\GSIRSelev\GsirController::class, 'principal_get'])->name('gsir_selev.principal_get');
    Route::get('/gsir_selev/pdf_albaran/{recogida_id}', [App\Http\Controllers\GSIRSelev\GsirController::class, 'pdf_albaran'])->name('gsir_selev.pdf_albaran');

    // GASTOS
    Route::get('/gsir_selev/gastos', [App\Http\Controllers\GSIRSelev\GsirController::class, 'gastos'])->name('gsir_selev.gastos');

    // ADMIN
    Route::get('/gsir_selev/admin', [App\Http\Controllers\ADMIN\AdminController::class, 'index'])->name('gsir_selev.admin');
  });

  //==============================
  // RUTAS
  //==============================
  Route::get('/rutas', [App\Http\Controllers\RUTAS\RutasController::class, 'index'])->name('rutas.index');
  Route::get('/ruta/pto_recogida/{ruta}/{cod_prov_cli}', [App\Http\Controllers\RUTAS\RutasController::class, 'pto_recogida_info'])->where('ruta', '.*')->name('rutas.pto_recogida_info');
  Route::get('/ruta/{ruta}', [App\Http\Controllers\RUTAS\RutasController::class, 'info'])->where('ruta', '.*')->name('rutas.info');
  Route::post('/ruta/info_cliente', [App\Http\Controllers\RUTAS\RutasController::class, 'info_cliente'])->name('rutas.info_cliente');
  Route::post('/ruta/cambiar_vehiculo/{ruta_id}', [App\Http\Controllers\RUTAS\RutasController::class, 'cambiar_vehiculo'])->name('rutas.cambiar_vehiculo');
  Route::post('/ruta/cambio_vehiculo_comprobar_matricula', [App\Http\Controllers\RUTAS\RutasController::class, 'comprobar_matricula'])->name('rutas.comprobar_matricula');
  Route::post('/ruta/finalizar/{cod_ruta}', [App\Http\Controllers\RUTAS\RutasController::class, 'finalizar'])->where('cod_ruta', '.*')->name('rutas.finalizar');
  Route::post('/ruta/asignar_cantidad_producto', [App\Http\Controllers\RUTAS\RutasController::class, 'asignar_cantidad_producto'])->name('rutas.asignar_cantidad_producto');


  //==============================
  // VEHICULOS
  //==============================
  Route::get('/vehiculos', [App\Http\Controllers\VEHICULOS\VehiculosController::class, 'index'])->name('vehiculos.index');
  Route::post('/vehiculos/info_ajax', [App\Http\Controllers\VEHICULOS\VehiculosController::class, 'info_ajax'])->name('vehiculos.info_ajax');


  //==============================
  // PENDIENTES DESCARGA
  //==============================
  Route::get('/pendientes_descarga', [App\Http\Controllers\PEND_DESCARGA\PendDescargaController::class, 'index'])->name('pend_descarga.index');
  Route::post('/pendientes_descarga/descargar', [App\Http\Controllers\PEND_DESCARGA\PendDescargaController::class, 'descargar'])->name('pend_descarga.descargar');






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
