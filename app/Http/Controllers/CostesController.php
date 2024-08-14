<?php

namespace App\Http\Controllers;

use App\Models\CliProv;
use App\Models\Costes;
use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CostesController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Lista de costes de la aplicacion
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $costes = Costes::all();
        return view('costes.index')->with(compact('costes'));
    }

    
    /**
     * Crear un nuevo coste
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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


    /**
     * Creamos un coste de tipo mantenimiento para el vehiculo en el que nos encontramos
     * @param \Illuminate\Http\Request $request
     * @param int $vehiculo_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create_mant(Request $request, $vehiculo_id)
    {
        $coste = new Costes();
        $coste->tipo = 'MANTENIMIENTO';
        $coste->fecha = $request->fecha_mant;
        $coste->descripcion = $request->descripcion_mant;
        $coste->valor = $request->coste_mant;
        $coste->aplicado_a = 'vehiculo';
        $coste->entidad_id = $vehiculo_id;
        $coste->save();

        return back()->with('notification', 'Mantenimiento creado correctamente.');
    }


    /**
     * Cargar los vehiculos o los clientes dependiendo del select del usuario en la vista
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function cargar_entidades(Request $request)
    {
        $lista_final = match ($request->aplicado_a) {
            'vehiculo' => Vehiculos::all(),
            'cliente' => CliProv::all(),
            default => [],
        };

        return response()->json($lista_final);
    }


    /**
     * Eliminar un coste
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $coste = Costes::find($request->id_eliminar);
        $coste->delete();

        return back()->with('notification', 'Coste eliminado correctamente.');
    }

}
