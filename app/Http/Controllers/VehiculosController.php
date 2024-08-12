<?php

namespace App\Http\Controllers;

use App\Models\Mantenimientos;
use App\Models\PuntoRecogida;
use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class VehiculosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Mostrar todos los vehiculos
     */
    public function index()
    {
        $vehiculos = Vehiculos::all();
        return view('vehiculos.index')->with(compact('vehiculos'));
    }


    /**
     * Crear un nuevo vehiculo.
     */
    public function create(Request $request)
    {
        $vehiculo = new Vehiculos();
        $vehiculo->nombre = $request->nombre;
        $vehiculo->tipo = $request->tipo;
        $vehiculo->matricula = $request->matricula;
        $vehiculo->seguro = $request->seguro;
        $vehiculo->itv = $request->itv;
        $vehiculo->adr = $request->adr;
        $vehiculo->capacidad = $request->capacidad;
        $vehiculo->ud_medida = $request->ud_medida;
        $vehiculo->empresa = $request->empresa;
        $vehiculo->tara = $request->tara;
        $vehiculo->PMA = $request->PMA;
        $vehiculo->carga_util = $request->carga_util;
        $vehiculo->estado = $request->estado;
        $vehiculo->consumo = $request->consumo;
        $vehiculo->kilometraje = $request->kilometraje;
        $vehiculo->fecha_amortizacion = $request->fecha_amortizacion;
        $vehiculo->save();

        return back()->with('notification', 'Vehiculo creado correctamente.');
    }

    public function show($id)
    {
        $vehiculo = Vehiculos::find($id);
        $mantenimientos = Mantenimientos::where('vehiculo_id', $id)->get();
        return view('vehiculos.show')->with(compact('vehiculo', 'mantenimientos'));
    }


    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculos::find($id);
        $vehiculo->nombre = $request->nombre;
        $vehiculo->tipo = $request->tipo;
        $vehiculo->matricula = $request->matricula;
        $vehiculo->seguro = $request->seguro;
        $vehiculo->itv = $request->itv;
        $vehiculo->adr = $request->adr;
        $vehiculo->capacidad = $request->capacidad;
        $vehiculo->ud_medida = $request->ud_medida;
        $vehiculo->empresa = $request->empresa;
        $vehiculo->tara = $request->tara;
        $vehiculo->PMA = $request->PMA;
        $vehiculo->carga_util = $request->carga_util;
        $vehiculo->estado = $request->estado;
        $vehiculo->consumo = $request->consumo;
        $vehiculo->kilometraje = $request->kilometraje;
        $vehiculo->fecha_amortizacion = $request->fecha_amortizacion;
        $vehiculo->save();

        return back()->with('notification', 'Vehiculo guardado correctamente.');
    }

    public function destroy(Request $request)
    {
        $vehiculo = Vehiculos::find($request->id_eliminar);
        $vehiculo->delete();

        return back()->with('notification', 'Vehiculo eliminado correctamente.');
    }
}
