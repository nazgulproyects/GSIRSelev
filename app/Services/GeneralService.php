<?php

namespace App\Services;

use App\Models\MES\BE\TanqueArticulos;
use App\Models\MES\BE\Tanques;
use App\Models\MES\BE\Trasvases;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GeneralService
{

    /**
     * Devuelve el código del conductor
     */
    public static function codigoConductor()
    {
        $Conductor = '$Conductor';
        $f4e2b823 = '$f4e2b823';

        $dni = auth()->user()->username;

        if (auth()->user()->empresa == 'SELEV') {
            $cod_conductor = DB::connection('mavaser')->select("select [Cod_ Conductor] FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Conductor$f4e2b823-5811-49c6-a41c-7c9707074208] WHERE DNI = '$dni'")[0]->{'Cod_ Conductor'};
        } elseif (auth()->user()->empresa == 'REMITTEL') {
            $cod_conductor = DB::connection('mavaser')->select("select [Cod_ Conductor] FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Conductor$f4e2b823-5811-49c6-a41c-7c9707074208] WHERE DNI = '$dni'")[0]->{'Cod_ Conductor'};
        }

        return $cod_conductor;
    }

    public static function listaVehiculos()
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

        return $vehiculos;
    }
}
