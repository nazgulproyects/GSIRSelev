<?php

namespace App\Http\Controllers;

use App\Models\CliProv;
use App\Models\Contratos;
use App\Models\PuntoRecogida;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PuntosRecogidaController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $puntos = PuntoRecogida::all();
        $cli_provs = CliProv::all();
        $contratos = Contratos::all();
        return view('puntos_recogida.puntos_recogida')->with(compact('puntos', 'cli_provs', 'contratos'));
    }

    public function show($id)
    {
        $punto_recogida = PuntoRecogida::find($id);
        $cli_provs = CliProv::all();
        return view('puntos_recogida.show')->with(compact('punto_recogida', 'cli_provs'));
    }

    public function create(Request $request)
    {
        $punto_recogida = new PuntoRecogida();
        $punto_recogida->nombre = $request->nombre;
        $punto_recogida->latitud = $request->latitud;
        $punto_recogida->longitud = $request->longitud;
        $punto_recogida->cli_prov_id = $request->cli_prov_id;
        $punto_recogida->save();

        return back()->with('notification', 'Punto de Recogida creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $punto_recogida = PuntoRecogida::find($id);
        $punto_recogida->nombre = $request->nombre;
        $punto_recogida->latitud = $request->latitud;
        $punto_recogida->longitud = $request->longitud;
        $punto_recogida->cli_prov_id = $request->cli_prov_id;
        $punto_recogida->save();

        return back()->with('notification', 'Punto de Recogida guardado correctamente.');
    }

    public function destroy(Request $request)
    {
        $punto_recogida = PuntoRecogida::find($request->id_eliminar);
        $punto_recogida->delete();

        return back()->with('notification', 'Punto de Recogida eliminado correctamente.');
    }
}
