<?php

namespace App\Http\Controllers\VEHICULOS;

use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class VehiculosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Muestra la lista de vehículos
     */
    public function index()
    {
        $Vehiculo = '$Vehiculo';
        $f4e2b823 = '$f4e2b823';

        if (auth()->user()->empresa == 'SELEV') {
            $vehiculos = DB::connection('mavaser')->select("
            SELECT 
            'SELEV' AS EMPRESA             
                ,[Cod_ vehiculo]
                ,[Matricula camion]
                ,[Matricula remolque]    
                ,[Cod_ empresa transporte]
                            ,CASE[Tipo vehiculo]
                                WHEN 0 THEN 'INTERNO'
                                        WHEN 1 THEN 'EXTERNO'
                            END AS Tipo
                ,[Remolque]
                ,[Rigido]
                ,[Cod_ Autorizac_ Transportista]
            FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Vehiculo$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE [Baja]=0 
            AND   App=1
        ");
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $vehiculos = DB::connection('mavaser')->select("
            SELECT 
            'REMITTEL' AS EMPRESA             
                ,[Cod_ vehiculo]
                ,[Matricula camion]
                ,[Matricula remolque]    
                ,[Cod_ empresa transporte]
                            ,CASE[Tipo vehiculo]
                                WHEN 0 THEN 'INTERNO'
                                        WHEN 1 THEN 'EXTERNO'
                            END AS Tipo
                ,[Remolque]
                ,[Rigido]
                ,[Cod_ Autorizac_ Transportista]
            FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Vehiculo$f4e2b823-5811-49c6-a41c-7c9707074208]
            WHERE [Baja]=0 
            AND   App=1
        ");
        }

        return view('GSIRSelev.vehiculos')->with(compact('vehiculos'));
    }

    /**
     * Muestra la información de un vehículo
     * 
     * @param Request $request Datos de la petición AJAX
     */
    public function info_ajax(Request $request)
    {
        // 1. Buscamos el vehiculo en la base de datos
        $vehiculo = Vehiculos::where('matricula', $request->matricula)->first();

        // 2. Si no existe, lo creamos
        if ($vehiculo == null) {
            $vehiculo = new Vehiculos();
            $vehiculo->matricula = $request->matricula;
            $vehiculo->save();
        }

        $vehiculo = Vehiculos::where('matricula', $request->matricula)->first();
        
        return response()->json($vehiculo);
    }
}
