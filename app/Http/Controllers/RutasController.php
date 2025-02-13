<?php

namespace App\Http\Controllers;

use App\Imports\ImportRutaNew;
use App\Models\PuntoRecogida;
use App\Models\Ruta;
use App\Models\RutaNew;
use App\Models\RutasPuntosRecogida;
use App\Models\User;
use App\Models\Vehiculos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;

class RutasController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Mostrar todas las rutas planificadas.
     */
    public function index()
    {
        $rutas = Ruta::all();
        $conductores = User::where('tipo', 'Conductor')->get(); // Aqui se debera filtrar solo por los que sean de tipo conductor
        $vehiculos = Vehiculos::all();
        return view('rutas.index')->with(compact('rutas', 'conductores', 'vehiculos'));
    }


    /**
     * Crear una nueva ruta planificada
     * 
     * @param Request $request
     */
    public function create(Request $request)
    {
        $ruta = new Ruta();
        $ruta->nombre = $request->nombre;
        $ruta->fecha = $request->fecha;
        $ruta->vehiculo_id = $request->vehiculo_id;
        $ruta->usuario_id = $request->usuario_id;
        $ruta->hora_inicio_prop = $request->hora_inicio_prop;
        $ruta->hora_fin_prop = $request->hora_fin_prop;
        $ruta->km_inicio = $request->km_inicio;
        $ruta->km_fin = $request->km_fin;
        $ruta->empresa = $request->empresa;
        $ruta->save();

        return back()->with('notification', 'Ruta planificada creada correctamente.');
    }


    /**
     * Mostrar la info de una ruta.
     */
    public function show($ruta_id)
    {
        $ruta = Ruta::find($ruta_id);
        $conductores = User::all(); // Aqui se debera fiultrar sol por lo s que sean de tipo conductor
        $vehiculos = Vehiculos::all();
        $puntos_recogida = PuntoRecogida::all();
        $rutas_puntos_recogida = RutasPuntosRecogida::where('ruta_id', $ruta_id)->orderBy('orden', 'asc')->get();
        return view('rutas.show')->with(compact('ruta', 'conductores', 'vehiculos', 'puntos_recogida', 'rutas_puntos_recogida'));
    }

    public function update(Request $request, $ruta_id)
    {
        $ruta = Ruta::find($ruta_id);
        $ruta->nombre = $request->nombre;
        $ruta->fecha = $request->fecha;
        $ruta->vehiculo_id = $request->vehiculo_id;
        $ruta->usuario_id = $request->usuario_id;
        $ruta->hora_inicio_prop = $request->hora_inicio_prop;
        $ruta->hora_fin_prop = $request->hora_fin_prop;
        $ruta->km_inicio = $request->km_inicio;
        $ruta->km_fin = $request->km_fin;
        $ruta->empresa = $request->empresa;
        $ruta->save();

        return back()->with('notification', 'Ruta actualizada correctamente.');
    }

    public function destroy(Request $request)
    {
        $ruta = Ruta::find($request->id_eliminar);
        $ruta->delete();

        return back()->with('notification', 'Ruta eliminada correctamente.');
    }

    /**
     * Asignar un nuevo punto de recogida a la ruta seleccionada.
     */
    public function asignar_punto_recogida(Request $request, $ruta_id)
    {
        $nueva_ruta_pr = new RutasPuntosRecogida();
        $nueva_ruta_pr->ruta_id = $ruta_id;
        $nueva_ruta_pr->punto_recogida_id = $request->punto_recogida_id;
        $nueva_ruta_pr->save();

        // dejamos el punto recogida como asignado a una ruta
        $punto_recogida = PuntoRecogida::find($request->punto_recogida_id);
        $punto_recogida->asignado_a_ruta = $ruta_id;
        // $punto_recogida->asignado_a_contrato = $contrato->id;
        $punto_recogida->save();

        return back()->with('notification', 'Punto de recogida asignado a la ruta correctamente.');
    }

    public function coordenadas_pr(Request $request)
    {
        $ruta_pr = RutasPuntosRecogida::where('ruta_id', $request->ruta)->orderBy('orden', 'asc')->get();

        $url_google_maps = 'https://www.google.com/maps/dir/?api=1&origin=';

        for ($i = 0; $i < sizeof($ruta_pr); $i++) {
            // Obtenemos las coordenadas del punto de recogida
            $punto = $ruta_pr[$i]->punto_recogida->latitud . ',' . $ruta_pr[$i]->punto_recogida->longitud;

            if ($i == 0) { // Si es el primer punto (ORIGEN)
                $url_google_maps .= $punto;
            } else if ($i == sizeof($ruta_pr) - 1) { // Si es el ultimo punto (DESTINATION)
                $url_google_maps .= "&destination=" . $punto;
            } else if (sizeof($ruta_pr) > 2) { // Si hay mas de 2 puntos, el primero del medio de ellos, llevara el '&waypoints'
                if ($i == 1) {
                    $url_google_maps .= "&waypoints=" . $punto;
                } else {
                    $url_google_maps .= "|" . $punto;
                }
            }
        }
        $url_google_maps .= "&travelmode=driving";
        return response()->json($url_google_maps);
    }

    public function rutas_pr_eliminar(Request $request)
    {
        $ruta_punto_recogida = RutasPuntosRecogida::find($request->id_eliminar);
        $ruta_punto_recogida->delete();

        return back()->with('notification', 'Se ha eliminado el punto de recogida de la ruta correctamente.');
    }

    /**
     * Ordenar los puntos de recogida de la ruta segun el orden que haya dejado el usuario en el 'SORTABLE LIST'
     */
    public function valor_orden(Request $request, $ruta_id)
    {

        // Obtener los valores del array con lo que me viene del request (menos el primero que esta el token),
        // Lo que se aqui es que el primero - ... - ... - ultimo, sera el orden que ha dejado al final el usuario y el que tengo que guardar
        $values = $request->formulario; //array_slice(array_values($request->request->all()), 1);

        for ($i = 0; $i < sizeof($values); $i++) {
            $ruta_pr = RutasPuntosRecogida::find($values[$i]);
            $ruta_pr->orden = $i + 1;
            $ruta_pr->save();
        }
        return response()->json('OK');
    }



    // RUTAS NEW
    public function rutas2()
    {
        $datos = RutaNew::all();

        // Agrupar por fecha (solo la parte de fecha sin hora) y trabajador
        $resultado = $datos->groupBy(function ($item) {
            // Extraemos solo la fecha (sin hora)
            return Carbon::parse($item['fecha_retirada'])->toDateString();
        })->map(function ($group, $fecha) {
            return $group->groupBy('trabajador')->map(function ($trabajadores, $trabajador) use ($fecha) {
                return [
                    'fecha' => $fecha,
                    'trabajador' => $trabajador,
                    'total' => $trabajadores->count(),
                ];
            });
        });

        // Convertir el resultado a un formato más legible si es necesario
        $resultado = $resultado->flatten(1);

        return view('rutas2.index')->with(compact('resultado'));
    }

    public function importarExcel(Request $request)
    {
        // PASO 1 GUARDAR EL ARCHIVO EXCEL
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls',
        ]);
        $archivo = $request->file('archivo');
        $nombreOriginal = $archivo->getClientOriginalName();
        $rutaArchivo = $archivo->storeAs('rutas', $nombreOriginal);

        // PASO 2: Importar los datos y guardarlos en la tabla
        Excel::import(new ImportRutaNew, $archivo);

        return back();
    }

    public function info_ruta($fecha, $trabajador)
    {
        $puntos_ruta = RutaNew::whereDate('fecha_retirada', $fecha)->where('trabajador', $trabajador)->get();

        return view('rutas2.ruta_info')->with(compact('puntos_ruta', 'fecha', 'trabajador'));
    }
}
