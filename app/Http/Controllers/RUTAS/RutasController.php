<?php

namespace App\Http\Controllers\RUTAS;

use App\Models\PuntoRecogida;
use App\Models\Ruta;
use App\Services\GeneralService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class RutasController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Muestra la vista de rutas
     * 
     * @return view Vista de rutas
     */
    public function index()
    {

        $Conductor = '$Conductor';
        $f4e2b823 = '$f4e2b823';
        $Ruta = '$Ruta';

        $cod_conductor = 'CEXT-22226'; // Esto va con consulta

        $rutas_nav = collect(DB::connection('mavaser')->select("
            SELECT [No_ ruta diaria]
                ,[Descripcion]
                ,[Fecha emision ruta]
                ,[Kms_ ruta]
                ,[Cod_ conductor]
                ,[Nombre conductor]
                ,[Cod_ empresa transporte]
                ,[Nombre empresa transporte]
                ,[Cod_ vehiculo]
                ,[Cod_ Remolque 1]
                ,[Cod_ Remolque 2]
                ,[Bloquear]
                ,[Tolva Entrada]    
                ,[Ruta secundaria]
                ,[Ruta principal]
                ,[Ruta de Gestion Externa]
            FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE  [Cod_ conductor]='$cod_conductor'
        "));

        $rutas_nav->transform(function ($ruta) {
            $ruta_web = Ruta::where('codigo', $ruta->{'No_ ruta diaria'})->first();
            $ruta->estado = $ruta_web->estado ?? 'PENDIENTE'; // Si no hay estado, asigna 'PENDIENTE'
            return $ruta;
        });
        // CAST([Fecha emision ruta] AS DATE) = '2025-01-31' and

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
        // Si la ruta no existe, la crea 
        $ruta_web = Ruta::firstOrCreate(
            ['codigo' => $cod_ruta], // Condiciones de búsqueda
            ['codigo' => $cod_ruta, 'estado' => 'PENDIENTE'] // Valores para crear si no existe
        );

        $codigo_cond = $service->codigoConductor();

        $Ruta = '$Ruta';
        $f4e2b823 = '$f4e2b823';

        if (auth()->user()->empresa == 'SELEV') {
            $ruta_nav = DB::connection('mavaser')->select("
                SELECT [No_ ruta diaria]
                    ,[Descripcion]
                    ,[Fecha emision ruta]
                    ,[Kms_ ruta]
                    ,[Cod_ conductor]
                    ,[Nombre conductor]
                    ,[Cod_ empresa transporte]
                    ,[Nombre empresa transporte]
                    ,[Cod_ vehiculo]
                    ,[Cod_ Remolque 1]
                    ,[Cod_ Remolque 2]
                    ,[Bloquear]
                    ,[Tolva Entrada]    
                    ,[Ruta secundaria]
                    ,[Ruta principal]
                    ,[Ruta de Gestion Externa]
                FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
                WHERE [Cod_ conductor]='$codigo_cond' and [No_ ruta diaria]='$cod_ruta'
            ");
            $ruta_nav = !empty($ruta_nav) ? $ruta_nav[0] : null;
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $codigo_cond = 'CEXT-22226';
            $ruta_nav = DB::connection('mavaser')->select("
            SELECT [No_ ruta diaria]
                ,[Descripcion]
                ,[Fecha emision ruta]
                ,[Kms_ ruta]
                ,[Cod_ conductor]
                ,[Nombre conductor]
                ,[Cod_ empresa transporte]
                ,[Nombre empresa transporte]
                ,[Cod_ vehiculo]
                ,[Cod_ Remolque 1]
                ,[Cod_ Remolque 2]
                ,[Bloquear]
                ,[Tolva Entrada]    
                ,[Ruta secundaria]
                ,[Ruta principal]
                ,[Ruta de Gestion Externa]
            FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE [Cod_ conductor]='$codigo_cond' and [No_ ruta diaria]='$cod_ruta'
        ");
            $ruta_nav = !empty($ruta_nav) ? $ruta_nav[0] : null;
        }


        $vehiculos = [
            '0000AAA',
            '1111BBB',
            '2222CCC',
            '3333DDD',

        ];


        $Lin_ = '$Lin_';
        $f4e2b823 = '$f4e2b823';

        $puntos_recogida = DB::connection('mavaser')->select("
            SELECT
                [No_ ruta]
                ,[No_ linea]     
                ,[No_ Proveedor_Cliente]
                ,[Nombre]
                ,[Direccion 1]
                ,[Direccion 2]
                ,[Poblacion]
                ,[No_ telefono]
                ,[C_P_]
                ,[Provincia]
                ,[No_ producto]
                ,[Descripcion producto]
                ,[Bascula propia]
                ,[Tolva entrada]   
                ,[Cod_ Proveedor Asociado]   
                ,[Tolva Origen]
                ,[A convertir en Destino]
                ,[Empresa origen]
                ,[Empresa destino]
                ,[No_ ruta original]
                ,[No_ linea original]
                ,[Observaciones]
                ,[Productos adicionales]
                ,[Forma de pago]
                ,[Nº Tienda]
                ,[Grupo]
            FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE [No_ ruta]='$cod_ruta'
        ");

        return view('GSIRSelev.ruta_info')->with(compact('cod_ruta', 'ruta_web', 'ruta_nav', 'puntos_recogida', 'vehiculos', 'codigo_cond'));
    }


    /**
     * Muestra la vista de la información del punto de recogida
     * 
     * @param string $cod_ruta Código de la ruta
     * 
     * @return view Vista de la información del punto de recogida
     */
    public function pto_recogida_info($cod_ruta)
    {

        $Lin_ = '$Lin_';
        $f4e2b823 = '$f4e2b823';
        $Ruta = '$Ruta';

        $codigo_cond = 'CEXT-22226';

        $ruta_nav = DB::connection('mavaser')->select("
            SELECT [No_ ruta diaria]
                ,[Descripcion]
                ,[Fecha emision ruta]
                ,[Kms_ ruta]
                ,[Cod_ conductor]
                ,[Nombre conductor]
                ,[Cod_ empresa transporte]
                ,[Nombre empresa transporte]
                ,[Cod_ vehiculo]
                ,[Cod_ Remolque 1]
                ,[Cod_ Remolque 2]
                ,[Bloquear]
                ,[Tolva Entrada]    
                ,[Ruta secundaria]
                ,[Ruta principal]
                ,[Ruta de Gestion Externa]
            FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE  [Cod_ conductor]='$codigo_cond' AND [No_ ruta diaria]='$cod_ruta'
        ");

        $punto_recogida_nav = DB::connection('mavaser')->select("
            SELECT
                [No_ ruta]
                ,[No_ linea]     
                ,[No_ Proveedor_Cliente]
                ,[Nombre]
                ,[Direccion 1]
                ,[Direccion 2]
                ,[Poblacion]
                ,[No_ telefono]
                ,[C_P_]
                ,[Provincia]
                ,[No_ producto]
                ,[Descripcion producto]
                ,[Bascula propia]
                ,[Tolva entrada]   
                ,[Cod_ Proveedor Asociado]   
                ,[Tolva Origen]
                ,[A convertir en Destino]
                ,[Empresa origen]
                ,[Empresa destino]
                ,[No_ ruta original]
                ,[No_ linea original]
                ,[Observaciones]
                ,[Productos adicionales]
                ,[Forma de pago]
                ,[Nº Tienda]
                ,[Grupo]
            FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE [No_ ruta]='$cod_ruta'
        ");
        $punto_recogida_nav = !empty($punto_recogida_nav) ? $punto_recogida_nav[0] : null;

        $ruta_web = Ruta::where('codigo', $cod_ruta)->first();
        $punto_recogida = PuntoRecogida::firstOrCreate(
            ['no_linea' => $punto_recogida_nav->{'No_ linea'}], // Condiciones de búsqueda
            ['no_linea' => $punto_recogida_nav->{'No_ linea'}, 'ruta_id' => $ruta_web->id] // Valores para crear si no existe
        );

        $productos_nav = DB::connection('mavaser')->select("
            SELECT
                [No_ ruta]
                ,[No_ linea]     
                ,[No_ Proveedor_Cliente]
                ,[Nombre]
                ,[Direccion 1]
                ,[Direccion 2]
                ,[Poblacion]
                ,[No_ telefono]
                ,[C_P_]
                ,[Provincia]
                ,[No_ producto]
                ,[Descripcion producto]
                ,[Bascula propia]
                ,[Tolva entrada]   
                ,[Cod_ Proveedor Asociado]   
                ,[Tolva Origen]
                ,[A convertir en Destino]
                ,[Empresa origen]
                ,[Empresa destino]
                ,[No_ ruta original]
                ,[No_ linea original]
                ,[Observaciones]
                ,[Productos adicionales]
                ,[Forma de pago]
                ,[Nº Tienda]
                ,[Grupo]
            FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE [No_ ruta]='$cod_ruta'
        ");

        //dd($pto_recogida);
        // !REVISAR PORQUE CREO QUE ESTO ES LA LISTA DE PRODUCTOS Y AL FINAL LA INFO DEL PUNTO ESTA EN TODAS EL MISMO
        /* $productos = [
            [
                'id' => 1,
                'peso' => '1000',
                'num_linea' => '10000',
                'desc_prod' => 'GRASA/HUESO GRAN SUPERFICIE'
            ], [
                'id' => 2,
                'peso' => '1250',
                'num_linea' => '20000',
                'desc_prod' => 'PESCADO GRANDES SUPERFICIES'
            ],

        ];*/

        return view('GSIRSelev.ruta_pto_recogida')->with(compact('ruta_nav', 'punto_recogida_nav', 'productos_nav'));
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

        $Lin_ = '$Lin_';
        $f4e2b823 = '$f4e2b823';
        $punto_recogida = DB::connection('mavaser')->select("
            SELECT
                [No_ ruta]
                ,[No_ linea]     
                ,[No_ Proveedor_Cliente]
                ,[Nombre]
                ,[Direccion 1]
                ,[Direccion 2]
                ,[Poblacion]
                ,[No_ telefono]
                ,[C_P_]
                ,[Provincia]
                ,[No_ producto]
                ,[Descripcion producto]
                ,[Bascula propia]
                ,[Tolva entrada]   
                ,[Cod_ Proveedor Asociado]   
                ,[Tolva Origen]
                ,[A convertir en Destino]
                ,[Empresa origen]
                ,[Empresa destino]
                ,[No_ ruta original]
                ,[No_ linea original]
                ,[Observaciones]
                ,[Productos adicionales]
                ,[Forma de pago]
                ,[Nº Tienda]
                ,[Grupo]
            FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE [No_ ruta]='$request->cod_ruta'
        ");
        $punto_recogida = !empty($punto_recogida) ? $punto_recogida[0] : null;



        return response()->json($punto_recogida);
    }
}
