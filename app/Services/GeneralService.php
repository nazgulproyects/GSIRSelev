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
}
