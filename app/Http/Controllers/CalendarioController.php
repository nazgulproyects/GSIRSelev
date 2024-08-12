<?php

namespace App\Http\Controllers;

use App\Models\Contratos;
use App\Models\PuntoRecogida;
use App\Models\Ruta;
use App\Models\RutasPuntosRecogida;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CalendarioController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {

        return view('calendario.calendario');
    }

    public function getEvents()
    {

        $rutas = Ruta::all();
        $eventos_rutas = [];
        foreach ($rutas as $ruta) {
            $eventos_rutas[] = [
                'id' => $ruta->id,
                'title' => 'R: ' . $ruta->nombre,
                'start' => $ruta->fecha,
                'color' => '#4DC6FF',
                'tipo' => 'ruta',
                'orden' => 1
            ];
        }


        // tenemos que coger solo los contratos que su pr no este dentro de una ruta ya
        // $contratos = Contratos::whereHas('punto_recogida', function ($query) {
        //     $query->where('asignado_a_ruta', '==', 0);
        // })->get();
        $contratos = Contratos::all();

        // SI EL CONTRATO ESTA ACTIVO, SI NO ESTA ACTIVO YA NO SE DEBE MOSTRAR NADA
        $formattedEvents = [];
        foreach ($contratos as $contrato) {

            $formattedEvents[] = [
                'id' => $contrato->id,
                'title' => $contrato->punto_recogida->nombre . ' (' . $contrato->codigo . ')',
                'start' => $contrato->punto_recogida->fecha_recogida_propuesta,
                'color' => '#FFC44D',
                'tipo' => 'contrato',
                'orden' => 2
            ];
        }


        $allEvents = array_merge($eventos_rutas, $formattedEvents);

        return response()->json($allEvents);
    }

    public function crear_ruta(Request $request)
    {
        $contrato = Contratos::find($request->contrato_id);

        // Primero crearmos la ruta
        $nueva_ruta = new Ruta();
        $nueva_ruta->nombre = 'R' . $request->contrato_id;
        $nueva_ruta->fecha = $contrato->fecha_recogida_propuesta;
        $nueva_ruta->save();

        // Despues asignamos el contrato seleccionado como punto de recogida dentro de la ruta
        $nueva_ruta_pr = new RutasPuntosRecogida();
        $nueva_ruta_pr->ruta_id = $nueva_ruta->id;
        $nueva_ruta_pr->punto_recogida_id = $contrato->punto_recogida_id;
        $nueva_ruta_pr->save();

        // dejamos el punto recogida como asignado a una ruta
        $punto_recogida = PuntoRecogida::find($contrato->punto_recogida_id);
        $punto_recogida->asignado_a_ruta = $nueva_ruta->id;
        $punto_recogida->asignado_a_contrato = $contrato->id;
        $punto_recogida->save();

        return response()->json('OK');
    }
}
