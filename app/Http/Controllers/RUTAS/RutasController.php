<?php

namespace App\Http\Controllers\RUTAS;

use App\Models\PendientesDescarga;
use App\Models\ProductosAdicionales;
use App\Models\ProductosPuntos;
use App\Models\PuntoRecogida;
use App\Models\Ruta;
use App\Models\User;
use App\Models\VehiculosRuta;
use App\Services\GeneralService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use consultaPageWS;
use consultaWS;


include_once('C:\xampp\htdocs\GSIRSelev\app\LinkWS\WebServices.php');

class RutasController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Muestra la vista de rutas
     * 
     * @return view Vista de rutas
     */
    public function index(GeneralService $service)
    {
        $Conductor = '$Conductor';
        $f4e2b823 = '$f4e2b823';
        $Ruta = '$Ruta';

        $cod_conductor = $service->codigoConductor();
        $fechaActual = now()->format('d.m.Y');

        if (auth()->user()->empresa == 'SELEV') {
            $rutas_nav = DB::connection(SELEV_BC)->table(SELEV_Ruta_diaria)->where('Cod_ conductor', $cod_conductor)->where('Fecha emision ruta', $fechaActual)->get();
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $rutas_nav = DB::connection(SELEV_BC)->table(REMITTEL_Ruta_diaria)->where('Cod_ conductor', $cod_conductor)->where('Fecha emision ruta', $fechaActual)->get();
        }

        $rutas_nav->transform(function ($ruta) {
            $ruta_web = Ruta::where('codigo', $ruta->{'No_ ruta diaria'})->first();
            $ruta->estado = $ruta_web->estado ?? 'PENDIENTE'; // Si no hay estado, asigna 'PENDIENTE'
            return $ruta;
        });

        return view('GSIRSelev.rutas')->with(compact('rutas_nav', 'cod_conductor'));
    }


    /**
     * Muestra la vista de la información de la ruta
     * 
     * @param string $cod_ruta Código de la ruta
     * @param GeneralService $service Servicio general
     * 
     * @return view Vista de la información de la ruta
     */
    public function info($cod_ruta, GeneralService $service)
    {
        $codigo_cond = $service->codigoConductor();

        if (auth()->user()->empresa == 'SELEV') {
            $ruta_nav = DB::connection(SELEV_BC)->table(SELEV_Ruta_diaria)->where('Cod_ conductor', $codigo_cond)->where('No_ ruta diaria', $cod_ruta)->first();
            $puntos_recogida_agrup = DB::connection(SELEV_BC)->table(SELEV_Linea_Ruta_diaria)->where('No_ ruta', $cod_ruta)->select('No_ Proveedor_Cliente', 'Nombre', 'Direccion 1', 'Orden Impresion', 'No_ ruta')->groupBy('No_ Proveedor_Cliente', 'Nombre', 'Direccion 1', 'Orden Impresion', 'No_ ruta')->orderBy('Orden Impresion', 'ASC')->get();
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $ruta_nav = DB::connection(SELEV_BC)->table(REMITTEL_Ruta_diaria)->where('Cod_ conductor', $codigo_cond)->where('No_ ruta diaria', $cod_ruta)->first();
            $puntos_recogida_agrup = DB::connection(SELEV_BC)->table(REMITTEL_Linea_Ruta_diaria)->where('No_ ruta', $cod_ruta)->select('No_ Proveedor_Cliente', 'Nombre', 'Direccion 1', 'Orden Impresion', 'No_ ruta')->groupBy('No_ Proveedor_Cliente', 'Nombre', 'Direccion 1', 'Orden Impresion', 'No_ ruta')->orderBy('Orden Impresion', 'ASC')->get();
        }


        //$ruta_nav = !empty($ruta_nav) ? $ruta_nav[0] : null;


        // Si la ruta no existe, la crea 
        $ruta_web = Ruta::firstOrCreate(
            ['codigo' => $cod_ruta], // Condiciones de búsqueda
            [
                'codigo' => $cod_ruta,  // Valores para crear si no existe
                'estado' => 'PENDIENTE',
                'empresa' => auth()->user()->empresa
            ]
        );

        // Aqui es un o por producto ??
        $puntos_recogida_agrup->transform(function ($punto) {
            $ruta = Ruta::where('codigo', $punto->{'No_ ruta'})->first();
            $punto_rec_web = PuntoRecogida::where('ruta_id', $ruta->id)->where('no_prov_cli', $punto->{'No_ Proveedor_Cliente'})->first();
            $punto->estado = $punto_rec_web->estado ?? 'PENDIENTE'; // Si no hay estado, asigna 'PENDIENTE'
            return $punto;
        });



        // Guardamos si hay ya en Navision un vehículo asociado a la ruta
        $vehiculo_ruta = VehiculosRuta::where('cod_ruta', $cod_ruta)->orderBy('id', 'desc')->first();
        if ($vehiculo_ruta == null) {
            $vehiculo_ruta = new VehiculosRuta();
            $vehiculo_ruta->cod_ruta = $cod_ruta;
            $vehiculo_ruta->cod_vehiculo = $ruta_nav->{'Cod_ vehiculo'};
            $vehiculo_ruta->remolque_1 = $ruta_nav->{'Cod_ Remolque 1'};
            $vehiculo_ruta->remolque_2 = $ruta_nav->{'Cod_ Remolque 2'};
            $vehiculo_ruta->save();
        }

        // Esto viene de navision? 
        $vehiculos_nav = $service->listaVehiculos();

        $cod_vehiculo = '';
        $remolque_1 = '';
        $remolque_2 = '';
        $kms_iniciales = '';
        $vehiculo_asociado = VehiculosRuta::where('cod_ruta', $cod_ruta)->orderBy('id', 'desc')->first();
        if ($vehiculo_asociado != null) {
            $cod_vehiculo = $vehiculo_asociado->cod_vehiculo;
            $remolque_1 = $vehiculo_asociado->remolque_1;
            $remolque_2 = $vehiculo_asociado->remolque_2;
            $kms_iniciales = $vehiculo_asociado->km_iniciales;
        }

        // Lista con las direcciones para ruta general
        $lista_direcciones = [];
        foreach ($puntos_recogida_agrup as $punto) {
            if (auth()->user()->empresa == 'SELEV') {
                $punto_nav = DB::connection(SELEV_BC)->table(SELEV_Linea_Ruta_diaria)->where('No_ ruta', $cod_ruta)->where('No_ Proveedor_Cliente', $punto->{'No_ Proveedor_Cliente'})->orderBy('Orden Impresion', 'ASC')->get();
                if ($punto_nav != null) array_push($lista_direcciones, $punto_nav[0]->C_P_ . ' ' . $punto_nav[0]->{'Direccion 1'});
            } else if (auth()->user()->empresa == 'REMITTEL') {
                $punto_nav = DB::connection(SELEV_BC)->table(REMITTEL_Linea_Ruta_diaria)->where('No_ ruta', $cod_ruta)->where('No_ Proveedor_Cliente', $punto->{'No_ Proveedor_Cliente'})->orderBy('Orden Impresion', 'ASC')->get();
                if ($punto_nav != null) array_push($lista_direcciones, $punto_nav[0]->C_P_ . ' ' . $punto_nav[0]->{'Direccion 1'});
            }
        }
        if (count($lista_direcciones) === 1) {
            // Si solo hay una dirección, se muestra el marcador de búsqueda en Google Maps
            $direccion = urlencode($lista_direcciones[0]);
            $url_maps_general = "https://www.google.com/maps/search/?api=1&query={$direccion}";
        } elseif (count($lista_direcciones) === 2) {
            // Si hay dos direcciones, se muestra la ruta entre ellas (sin waypoints)
            $origen = urlencode($lista_direcciones[0]);
            $destino = urlencode($lista_direcciones[1]);
            $url_maps_general = "https://www.google.com/maps/dir/?api=1&origin={$origen}&destination={$destino}";
        } else {
            // Si hay más de dos direcciones, se utiliza la primera como origen, la última como destino y el resto como waypoints
            $origen = urlencode($lista_direcciones[0]);
            $destino = urlencode(end($lista_direcciones));
            $waypointsArray = array_slice($lista_direcciones, 1, -1);
            $waypointsCodificados = array_map('urlencode', $waypointsArray);
            $waypoints = implode('|', $waypointsCodificados);
            $url_maps_general = "https://www.google.com/maps/dir/?api=1&origin={$origen}&destination={$destino}&waypoints={$waypoints}";
        }

        return view('GSIRSelev.ruta_info')->with(compact('cod_ruta', 'ruta_web', 'ruta_nav', 'puntos_recogida_agrup', 'vehiculos_nav', 'codigo_cond', 'vehiculo_asociado', 'cod_vehiculo', 'remolque_1', 'remolque_2', 'kms_iniciales', 'url_maps_general'));
    }


    /**
     * Muestra la vista de la información del punto de recogida
     * 
     * @param string $cod_ruta Código de la ruta
     * 
     * @return view Vista de la información del punto de recogida
     */
    public function pto_recogida_info($cod_ruta, $cod_prov_cli, GeneralService $service)
    {

        /*
        if (iniciaWSlocal()) {

            //http://MigraSelev.selev.local:7047/SELEV_BC/WS 
            $consultapage = new consultaPageWS('TEST_REMITTEL%202017%2C%20S.L.', 'WS_Vehiculos', 'http://10.6.0.254:7047/SELEV_BC/WS');
            dd( $consultapage);
            $filter = [];
            $params = array('filter' => $filter, 'setSize' => 20);

            //Leemos la Page de Navision
            $resultado = $consultapage->ReadMultiple($params);
            //$consultapage->ejecucionErronea($resultado);
            dd($resultado);
            echo '<br>' . "<pre>";
            var_dump($resultado);
            echo "</pre>";

            dd('a');

            $Create_Rec = new stdClass();
            // parametros obtenidos del chorme, con el link del WS
            $Create_Rec->Cod_vehiculo                = 'valor_cod_vehiculo';
            $Create_Rec->Descripcion                 = 'valor_descripcion';
            $Create_Rec->Matricula_camion            = 'valor_matricula_camion';
            $Create_Rec->Matricula_remolque          = 'valor_matricula_remolque';
            $Create_Rec->Cod_empresa_transporte      = 'valor_cod_empresa_transporte';
            $Create_Rec->Tipo_vehiculo               = 'valor_tipo_vehiculo';
            $Create_Rec->Remolque                    = 'valor_remolque';
            $Create_Rec->Cod_Autorizac_Transportista = 'valor_cod_autorizac_transportista';

            $create = new stdClass();
            $create->WS_Vehiculos = $Create_Rec; //poner aqui el WS

            echo '<br>' . "<pre>";
            var_dump($create);
            echo "</pre>";

            $resultado = $consultapage->Create($create);
            $consultapage->ejecucionErronea($resultado);

            echo '<br>' . "<pre>";
            var_dump($resultado);
            echo "</pre>";

            //Finalizamos la conexion
            finalizaWS();
        }
        dd('fin prueba ws');    
        */


        $cod_conductor = $service->codigoConductor();

        $contacto = '';
        $email = '';
        $telefono = '';

        if (auth()->user()->empresa == 'SELEV') {
            $ruta_nav = DB::connection(SELEV_BC)->table(SELEV_Ruta_diaria)->where('Cod_ conductor', $cod_conductor)->where('No_ ruta diaria', $cod_ruta)->first();
            $punto_productos_nav = DB::connection(SELEV_BC)->table(SELEV_Linea_Ruta_diaria)->where('No_ ruta', $cod_ruta)->where('No_ Proveedor_Cliente', $cod_prov_cli)->orderBy('Orden Impresion', 'ASC')->get();

            $cli_prov = DB::connection(SELEV_BC)->table(SELEV_Customer)->where('No_', $cod_prov_cli)->first();
            if ($cli_prov == null) $cli_prov = DB::connection(SELEV_BC)->table(SELEV_Vendor)->where('No_', $cod_prov_cli)->first();
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $ruta_nav = DB::connection(SELEV_BC)->table(REMITTEL_Ruta_diaria)->where('Cod_ conductor', $cod_conductor)->where('No_ ruta diaria', $cod_ruta)->first();
            $punto_productos_nav = DB::connection(SELEV_BC)->table(REMITTEL_Linea_Ruta_diaria)->where('No_ ruta', $cod_ruta)->where('No_ Proveedor_Cliente', $cod_prov_cli)->orderBy('Orden Impresion', 'ASC')->get();

            $cli_prov = DB::connection(SELEV_BC)->table(REMITTEL_Customer)->where('No_', $cod_prov_cli)->first();
            if ($cli_prov == null) $cli_prov = DB::connection(SELEV_BC)->table(REMITTEL_Vendor)->where('No_', $cod_prov_cli)->first();
        }
        
        if ($cli_prov != null) {
            $contacto = $cli_prov->Contact;
            $email = $cli_prov->{'E-Mail'};
            $telefono = $cli_prov->{'Phone No_'};
        }


        if (sizeof($punto_productos_nav) == 0) dd('LA RUTA NO TIENE NINGÚN PRODUCTO ASIGNADO PARA RECOGER');

        $ruta_web = Ruta::where('codigo', $cod_ruta)->first();

        // Obtener/crear los puntos de recogida si no existen
        $punto_recogida_web = PuntoRecogida::where('no_prov_cli', $cod_prov_cli)->where('ruta_id', $ruta_web->id)->first();
        if ($punto_recogida_web == null) {
            $punto_recogida_web = new PuntoRecogida();
            $punto_recogida_web->no_prov_cli = $cod_prov_cli;
            $punto_recogida_web->ruta_id = $ruta_web->id;
            $punto_recogida_web->estado = 'PENDIENTE';
            $punto_recogida_web->save();
        }

        // Creamos los productos de los puntos de recogida si no existen
        foreach ($punto_productos_nav as $punto_nav) {
            $prod_punto = ProductosPuntos::where('punto_recogida_id', $punto_recogida_web->id)->where('no_linea', $punto_nav->{'No_ linea'})->first();
            if ($prod_punto == null) {
                $prod_punto = new ProductosPuntos();
                $prod_punto->punto_recogida_id = $punto_recogida_web->id;
                $prod_punto->no_linea = $punto_nav->{'No_ linea'};
                $prod_punto->codigo = $punto_nav->{'No_ producto'};
                $prod_punto->nombre = $punto_nav->{'Descripcion producto'};
                $prod_punto->cantidad = 0;
                $prod_punto->save();
            }
        }

        // Ponermos el estado y la cantidad de los productos en el punto de recogida de la web
        $punto_productos_nav->transform(function ($punto_nav) {
            $ruta_web = Ruta::where('codigo', $punto_nav->{'No_ ruta'})->first();
            $punto_recogida = PuntoRecogida::where('ruta_id', $ruta_web->id)->where('no_prov_cli', $punto_nav->{'No_ Proveedor_Cliente'})->first();
            $punto_nav->estado = $punto_recogida->estado ?? 'PENDIENTE'; // Si no hay estado, asigna 'PENDIENTE'

            // Luego asignamos también la cantidad del producto (si hay)
            $prod_punto = ProductosPuntos::where('punto_recogida_id', $punto_recogida->id)->where('no_linea', $punto_nav->{'No_ linea'})->first();
            $punto_nav->cantidad = $prod_punto->cantidad ?? 0;
            return $punto_nav;
        });

        $total_cantidad = ProductosPuntos::where('punto_recogida_id', $punto_recogida_web->id)->sum('cantidad');
        $productos_adicionales = ProductosAdicionales::where('ruta_id', $ruta_web->id)->where('punto_recogida_id', $punto_recogida_web->id)->get();

        $lista_prods = [
            'MALMP18' => 'ABRILLANTADOR MÁQUINA 5L',
            'MALMP17' => 'DETERGENTE MÁQUINA 5L',
            'MALMP16' => 'BAYETA MICROFIBRA',
            'MALMP15' => 'ESTROPAJO VERDE PACK 12UN',
            'MALMP14' => 'BOLSAS BASURA DIELITE',
            'MALMP13' => 'MANTELITO ECOLOGICO',
            'MALMP12' => 'ABRILLANTADOR MAQUINA (5 L)',
            'MALMP11' => 'DETERGENTE MAQUINA ( 6KG )',
            'MALMP10' => '1 LITRO DESENGRASANTE',
            'MALMP09' => '5 LITROS LEJIA',
            'MALMP08' => 'TRAMPA DE GRASA',
            'MALMP07' => '5 LITROS FAIRY',
            'MALMP06' => '5 LITROS LAVAVAJILLAS',
            'MALMP05' => '5 LITROS FREGASUELO',
            'MALMP04' => '5 LITROS DESENGRASANTE',
            'MALMP03' => '6 ROLLOS PAPEL CHEMINE',
            'MALMP02' => 'LIMPIEZA LOTE 2',
            'MALMP01' => 'LIMPIEZA LOTE 1',
            'FLTSERV6' => 'FILTRO INOX',
            'FLTSERV7' => 'FILTRO CARBONO',
            'FLTSERV8' => 'RESTO FILTROS',
            'CMPSERV' => 'SERVICIO LIMPIEZA CAMPANA'
        ];

        return view('GSIRSelev.ruta_pto_recogida')->with(compact('ruta_nav', 'punto_productos_nav', 'punto_recogida_web', 'total_cantidad', 'productos_adicionales', 'lista_prods', 'contacto', 'email', 'telefono'));
    }


    /**
     * Muestra la vista de la información del cliente
     * 
     * @param Request $request Petición
     * 
     * @return view Vista de la información del cliente
     */
    public function info_cliente(Request $request)
    {
        if (auth()->user()->empresa == 'SELEV') {
            $punto_recogida = DB::connection(SELEV_BC)->table(SELEV_Linea_Ruta_diaria)->where('No_ ruta', $request->cod_ruta)->where('No_ Proveedor_Cliente', $request->no_prov_cli)->first();
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $punto_recogida = DB::connection(SELEV_BC)->table(REMITTEL_Linea_Ruta_diaria)->where('No_ ruta', $request->cod_ruta)->where('No_ Proveedor_Cliente', $request->no_prov_cli)->first();
        }

        $datos = [
            'localidad' => $punto_recogida->Poblacion,
            'provincia' => $punto_recogida->Provincia,
            'direccion' => $punto_recogida->{'Direccion 1'},
            'grupo' => $punto_recogida->Grupo,
            'tienda' => $punto_recogida->{'Nº Tienda'},
            'tipo_pago' => $punto_recogida->{'Forma de pago'},
            'remuneracion' => '',
            'prod_adicionales' => $punto_recogida->{'Productos adicionales'} == 0 ? 'NO' : 'SI'
        ];

        return response()->json($datos);
    }


    /**
     * Cambia el vehículo de la ruta
     * 
     * @param Request $request Petición
     * @param string $ruta_id ID de la ruta
     * 
     * @return back
     */
    public function cambiar_vehiculo(Request $request, $ruta_id)
    {

        // Creamos el nuevo registro
        $ruta = Ruta::find($ruta_id);
        $vehiculo_ruta = new VehiculosRuta();
        $vehiculo_ruta->cod_ruta = $ruta->codigo;
        $vehiculo_ruta->cod_vehiculo = $request->matricula_nuevo_vehiculo;
        $vehiculo_ruta->remolque_1 = null;
        $vehiculo_ruta->remolque_2 = null;
        $vehiculo_ruta->km_iniciales = $request->km_iniciales_input;
        $vehiculo_ruta->save();


        // Al antiguo registro le ponemos los km finales
        $vehiculo_ruta_antiguo = VehiculosRuta::where('cod_ruta', $ruta->codigo)->where('cod_vehiculo', $request->matricula_anterior_val)->orderBy('id', 'desc')->first();
        $vehiculo_ruta_antiguo->km_finales = $request->km_finales_input;
        $vehiculo_ruta_antiguo->save();


        // ===== WEB SERVICE PARA ENVIAR A NAVISION EL NUEVO VEHÍCULO ASOCIADO A LA RUTA =====



        return back();
    }

    public function comprobar_matricula(Request $request)
    {
        if (auth()->user()->empresa == 'SELEV') {
            $vehiculo = DB::connection(SELEV_BC)->table(SELEV_Vehiculos)->where('Baja', 0)->where('App', 1)->where('Cod_ vehiculo', $request->matricula)->first();
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $vehiculo = DB::connection(SELEV_BC)->table(REMITTEL_Vehiculos)->where('Baja', 0)->where('App', 1)->where('Cod_ vehiculo', $request->matricula)->first();
        }

        $existe = $vehiculo != null;

        return response()->json($existe);
    }

    public function finalizar(Request $request, $cod_ruta)
    {
        $vehiculo_ruta = VehiculosRuta::where('cod_ruta', $cod_ruta)->orderBy('id', 'desc')->first();
        $vehiculo_ruta->km_finales = $request->km_finales;
        $vehiculo_ruta->save();

        $ruta_web = Ruta::where('codigo', $cod_ruta)->first();
        $ruta_web->fecha_finalizacion = $request->fecha_fin;

        if ($request->dejar_pendiente_descarga == 'on') {
            $pendiente_desc = new PendientesDescarga();
            $pendiente_desc->cod_ruta = $cod_ruta;
            $pendiente_desc->cod_vehiculo = $vehiculo_ruta->cod_vehiculo;
            $pendiente_desc->estado = 'PENDIENTE';
            $pendiente_desc->save();

            $ruta_web->estado = 'COMPLETADO PEND';
        } else {
            $ruta_web->estado = 'COMPLETADO';
        }
        $ruta_web->save();

        return back();
    }

    public function asignar_cantidad_producto(Request $request)
    {
        $punto_recogida_web = PuntoRecogida::find($request->punto_recogida_web_id);

        $prod_punto = ProductosPuntos::where('punto_recogida_id', $punto_recogida_web->id)->where('no_linea', $request->no_linea)->first();
        if ($prod_punto == null) {
            $prod_punto = new ProductosPuntos();
            $prod_punto->punto_recogida_id = $punto_recogida_web->id;
            $prod_punto->no_linea = $request->no_linea;
            $prod_punto->cantidad = $request->cantidad;
            $prod_punto->save();
        } else {
            $prod_punto->cantidad = $request->cantidad;
            $prod_punto->save();
        }

        // Finalmente calculamos el total cantidad actual
        $total_cantidad = ProductosPuntos::where('punto_recogida_id', $punto_recogida_web->id)->sum('cantidad');

        return response()->json($total_cantidad);
    }

    public function nuevo_producto_adicional(Request $request)
    {
        $ruta = Ruta::where('codigo', $request->ruta_actual)->first();
        $punto_recogida_web = PuntoRecogida::find($request->punto_rec_actual);

        $nuevo_prod = new ProductosAdicionales();
        $nuevo_prod->nombre = $request->nombre_prod_adicional;
        $nuevo_prod->cantidad = $request->cant_prod_adicional;
        $nuevo_prod->ruta_id = $ruta->id;
        $nuevo_prod->punto_recogida_id = $punto_recogida_web->id;
        $nuevo_prod->tipo = $request->flexRadioDefault;
        $nuevo_prod->save();

        return back();
    }

    public function prod_adicional_guardar(Request $request)
    {
        $prod_adicional = ProductosAdicionales::find($request->prod_adicional_id);
        $prod_adicional->nombre = $request->nombre;
        $prod_adicional->cantidad = $request->cantidad;
        $prod_adicional->tipo = $request->tipo;
        $prod_adicional->save();

        return response()->json('OK');
    }


    public function guardar_datos_ruta($cod_ruta, Request $request)
    {
        $vehiculo_ruta = VehiculosRuta::where('cod_ruta', $cod_ruta)->orderBy('id', 'desc')->first();
        $vehiculo_ruta->remolque_1 = $request->remolque1_ruta;
        $vehiculo_ruta->remolque_2 = $request->remolque2_ruta;
        $vehiculo_ruta->km_iniciales = $request->km_iniciales;
        $vehiculo_ruta->save();

        return back();
    }

    public function guardar_firma_cliente(Request $request, $ruta_id)
    {
        if ($request->has('image')) {
            // Decodificar la imagen en base64
            $imageData = $request->input('image');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Guardar la imagen en el almacenamiento
            $fileName = 'firma_cliente.png';
            Storage::put('public/firmas/ruta_' . $ruta_id . '/' . $fileName, $image);

            return response()->json(['success' => true, 'file' => $fileName]);
        }

        return response()->json(['success' => false, 'message' => 'No se recibió la imagen']);
    }

    public function guardar_firma_conductor(Request $request, $ruta_id)
    {
        if ($request->has('image')) {
            // Decodificar la imagen en base64
            $imageData = $request->input('image');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Guardar la imagen en el almacenamiento
            $fileName = 'firma_conductor.png';
            Storage::put('public/firmas/ruta_' . $ruta_id . '/' . $fileName, $image);

            return response()->json(['success' => true, 'file' => $fileName]);
        }

        return response()->json(['success' => false, 'message' => 'No se recibió la imagen']);
    }
}
