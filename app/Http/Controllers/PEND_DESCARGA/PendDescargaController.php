<?php

namespace App\Http\Controllers\PEND_DESCARGA;

use App\Models\PendientesDescarga;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PendDescargaController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $pendientes_desc = PendientesDescarga::where('estado', 'PENDIENTE')->get();
       
        return view('GSIRSelev.planta')->with(compact('pendientes_desc'));
    }

    public function descargar(Request $request)
    {
        $desc_pend = PendientesDescarga::where('cod_ruta', $request->cod_ruta)->first();
        $desc_pend->estado = 'FINALIZADA';
        $desc_pend->save();

        $ruta = Ruta::where('codigo', $request->cod_ruta)->first();
        $ruta->estado = 'COMPLETADO';
        $ruta->save();

        return response()->json('OK');
    }
}
