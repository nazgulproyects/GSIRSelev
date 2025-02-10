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
            $rutas_nav = collect(DB::connection('mavaser')->select("
            SELECT *
            FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE  [Cod_ conductor]='$cod_conductor' and [Fecha emision ruta] = '$fechaActual'
        "));
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $rutas_nav = collect(DB::connection('mavaser')->select("
            SELECT *
            FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE  [Cod_ conductor]='$cod_conductor' and [Fecha emision ruta] = '$fechaActual'
        "));
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

        $Ruta = '$Ruta';
        $f4e2b823 = '$f4e2b823';
        $Lin_ = '$Lin_';

        if (auth()->user()->empresa == 'SELEV') {
            $ruta_nav = DB::connection('mavaser')->select("
                SELECT *
                FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE [Cod_ conductor]='$codigo_cond' and [No_ ruta diaria]='$cod_ruta'
            ");

            $puntos_recogida_agrup = collect(DB::connection('mavaser')->select("
                SELECT [No_ Proveedor_Cliente], [Nombre], [Direccion 1], [Orden Impresion], [No_ ruta]
                FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS 2017, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE [No_ ruta] = '$cod_ruta'
                GROUP BY [No_ Proveedor_Cliente], [Nombre], [Direccion 1], [Orden Impresion], [No_ ruta]
                ORDER BY [Orden Impresion] asc
            "));
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $ruta_nav = DB::connection('mavaser')->select("
                SELECT *
                FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE [Cod_ conductor]='$codigo_cond' and [No_ ruta diaria]='$cod_ruta'
            ");

            $puntos_recogida_agrup = collect(DB::connection('mavaser')->select("
                SELECT [No_ Proveedor_Cliente], [Nombre], [Direccion 1], [Orden Impresion], [No_ ruta]
                FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE [No_ ruta] = '$cod_ruta'
                GROUP BY [No_ Proveedor_Cliente], [Nombre], [Direccion 1], [Orden Impresion], [No_ ruta]
                ORDER BY [Orden Impresion] asc
            "));
        }

        $ruta_nav = !empty($ruta_nav) ? $ruta_nav[0] : null;

        // Si la ruta no existe, la crea 
        $ruta_web = Ruta::firstOrCreate(
            ['codigo' => $cod_ruta], // Condiciones de búsqueda
            [
                'codigo' => $cod_ruta,  // Valores para crear si no existe
                'estado' => 'PENDIENTE'
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
            $vehiculo_ruta->remolque_2 = $ruta_nav->{'Cod_ Remolque 1'};
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
        return view('GSIRSelev.ruta_info')->with(compact('cod_ruta', 'ruta_web', 'ruta_nav', 'puntos_recogida_agrup', 'vehiculos_nav', 'codigo_cond', 'vehiculo_asociado', 'cod_vehiculo', 'remolque_1', 'remolque_2', 'kms_iniciales'));
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
        $Lin_ = '$Lin_';
        $f4e2b823 = '$f4e2b823';
        $Ruta = '$Ruta';

        $cod_conductor = $service->codigoConductor();

        if (auth()->user()->empresa == 'SELEV') {
            $ruta_nav = DB::connection('mavaser')->select("
                SELECT *
                FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE  [Cod_ conductor]='$cod_conductor' AND [No_ ruta diaria]='$cod_ruta'
            ");

            $punto_productos_nav = collect(DB::connection('mavaser')->select("
                SELECT *
                FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE [No_ ruta] = '$cod_ruta' AND [No_ Proveedor_Cliente] = '$cod_prov_cli'
                ORDER BY [Orden Impresion] ASC;
            "));
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $ruta_nav = DB::connection('mavaser')->select("
                SELECT *
                FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE  [Cod_ conductor]='$cod_conductor' AND [No_ ruta diaria]='$cod_ruta'
            ");

            $punto_productos_nav = collect(DB::connection('mavaser')->select("
                SELECT *
                FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE [No_ ruta] = '$cod_ruta' AND [No_ Proveedor_Cliente] = '$cod_prov_cli'
                ORDER BY [Orden Impresion] ASC;
            "));
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

        //dd($punto_productos_nav[0]);

        return view('GSIRSelev.ruta_pto_recogida')->with(compact('ruta_nav', 'punto_productos_nav', 'punto_recogida_web', 'total_cantidad', 'productos_adicionales', 'lista_prods'));
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

        //! AQUI DEBERIA COGERSE LA INFO DEL PROV_CLI DE NAVISION
        $Lin_ = '$Lin_';
        $f4e2b823 = '$f4e2b823';

        if (auth()->user()->empresa == 'SELEV') {
            $punto_recogida = DB::connection('mavaser')->select("
                SELECT *
                FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE [No_ ruta]='$request->cod_ruta' and [No_ Proveedor_Cliente]='$request->no_prov_cli'
            ");
        } else if (auth()->user()->empresa == 'REMITTEL') {

            $punto_recogida = DB::connection('mavaser')->select("
                SELECT *
                FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE [No_ ruta]='$request->cod_ruta' and [No_ Proveedor_Cliente]='$request->no_prov_cli'
            ");
        }

        $datos = [
            'localidad' => $punto_recogida[0]->Poblacion,
            'provincia' => $punto_recogida[0]->Provincia,
            'direccion' => $punto_recogida[0]->{'Direccion 1'},
            'grupo' => $punto_recogida[0]->Grupo,
            'tienda' => $punto_recogida[0]->{'Nº Tienda'},
            'tipo_pago' => $punto_recogida[0]->{'Forma de pago'},
            'remuneracion' => '',
            'prod_adicionales' => $punto_recogida[0]->{'Productos adicionales'} == 0 ? 'NO' : 'SI'
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
        return back();
    }

    public function comprobar_matricula(Request $request)
    {
        $Vehiculo = '$Vehiculo';
        $f4e2b823 = '$f4e2b823';
        if (auth()->user()->empresa == 'SELEV') {
            $vehiculo = DB::connection('mavaser')->select("
                SELECT [Cod_ vehiculo]
                FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Vehiculo$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE [Baja]=0 AND App=1 AND [Cod_ vehiculo]='$request->matricula'
            ");
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $vehiculo = DB::connection('mavaser')->select("
            SELECT [Cod_ vehiculo]
            FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Vehiculo$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE [Baja]=0 AND App=1 AND [Cod_ vehiculo]='$request->matricula'
        ");
        }
        $existe = !empty($vehiculo) ? true : false;

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
