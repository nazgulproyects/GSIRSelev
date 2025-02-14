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
        $dni = auth()->user()->username;

        if (auth()->user()->empresa == 'SELEV') {
            $conductor = DB::connection(SELEV_BC)->table(SELEV_Conductores)->where('DNI', $dni)->first();
        } elseif (auth()->user()->empresa == 'REMITTEL') {
            $conductor = DB::connection(SELEV_BC)->table(REMITTEL_Conductores)->where('DNI', $dni)->first();
        }

        return $conductor->{'Cod_ Conductor'};
    }

    public static function listaVehiculos()
    {

        if (auth()->user()->empresa == 'SELEV') {
            $vehiculos = DB::connection(SELEV_BC)->table(SELEV_Vehiculos)->where('Baja', 0)->where('App', 1)->get();
        } else if (auth()->user()->empresa == 'REMITTEL') {
            $vehiculos = DB::connection(SELEV_BC)->table(REMITTEL_Vehiculos)->where('Baja', 0)->where('App', 1)->get();

            /*
            $vehiculos = DB::connection(SELEV_BC)->select("
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
            */
        }

        return $vehiculos;
    }
}
