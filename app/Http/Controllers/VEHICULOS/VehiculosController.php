<?php

namespace App\Http\Controllers\VEHICULOS;

use App\Models\Vehiculos;
use App\Services\GeneralService;
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
    public function index(GeneralService $service)
    {

        $vehiculos = $service->listaVehiculos();

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
