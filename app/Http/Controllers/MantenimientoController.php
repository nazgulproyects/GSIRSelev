<?php

namespace App\Http\Controllers;

use App\Models\Mantenimientos;
use App\Models\Recogida;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class MantenimientoController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function create(Request $request, $vehiculo_id)
    {
        $mant = new Mantenimientos();
        $mant->tipo = $request->tipo_mant;
        $mant->fecha = $request->fecha_mant;
        $mant->coste = $request->coste_mant;
        $mant->descripcion = $request->descripcion_mant;
        $mant->vehiculo_id = $vehiculo_id;
        $mant->save();

        return back()->with('notification', 'Mantenimiento creado correctamente.');
    }

    public function destroy(Request $request)
    {
        $mant = Mantenimientos::find($request->id_eliminar);
        $mant->delete();

        return back()->with('notification', 'Mantenimiento eliminado correctamente.');
    }
}
