<?php

namespace App\Http\Controllers;

use App\Models\CliProv;
use App\Models\Costes;
use App\Models\Mantenimientos;
use App\Models\Recogida;
use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CostesController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $costes = Costes::all();
        return view('costes.index')->with(compact('costes'));
    }

    public function create(Request $request)
    {
        $coste = new Costes();
        $coste->tipo = $request->tipo;
        $coste->fecha = $request->fecha;
        $coste->descripcion = $request->descripcion;
        $coste->valor = $request->valor;
        $coste->aplicado_a = $request->aplicado_a;
        $coste->entidad_id = $request->entidad_id;
        $coste->save();

        return back()->with('notification', 'Coste creado correctamente.');
    }

    public function cargar_entidades(Request $request)
    {
        $lista_final = match ($request->aplicado_a) {
            'vehiculo' => Vehiculos::all(),
            'cliente' => CliProv::all(),
            default => [],
        };

        return response()->json($lista_final);
    }

}
