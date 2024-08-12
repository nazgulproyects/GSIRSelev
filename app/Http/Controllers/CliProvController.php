<?php

namespace App\Http\Controllers;

use App\Models\CliProv;
use App\Models\Contratos;
use App\Models\PuntoRecogida;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class CliProvController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $cli_prov = CliProv::all();


        // Calcular proximos dias de recogida
        foreach ($cli_prov as $c_p) {
            // Obtener la fecha actual
            $fechaActual = Carbon::now();

            $fechaActual->addDays($c_p->frecuencia);

            // Verificar si la fecha final es sábado o domingo
            if ($fechaActual->isWeekend()) {
                // Si es fin de semana, sumar los días necesarios para llegar al lunes
                if ($fechaActual->isSaturday()) {
                    $fechaActual->addDays(2); // Sumar 2 días para llegar al lunes
                } elseif ($fechaActual->isSunday()) {
                    $fechaActual->addDay(); // Sumar 1 día para llegar al lunes
                }
            }

            $c_p->prox_dia_recogida = $fechaActual;
            $c_p->save();
        }
        return view('cli_prov.index')->with(compact('cli_prov'));
    }

    public function create(Request $request)
    {
        $cli_prov = new CliProv();
        $cli_prov->nombre = $request->nombre;
        $cli_prov->fecha_antiguedad = $request->fecha_antiguedad;
        $cli_prov->tramo_actual_comision = $request->tramo_actual_comision;
        $cli_prov->save();

        return back()->with('notification', 'Registro creado correctamente.');
    }

    public function show($id)
    {
        $cli_prov = CliProv::find($id);
        $puntos_recogida = PuntoRecogida::where('cli_prov_id', $id)->get();
        $contratos = Contratos::where('cli_prov_id', $id)->get();
        return view('cli_prov.show')->with(compact('cli_prov', 'puntos_recogida', 'contratos'));
    }

    public function update(Request $request, $id)
    {
        $cli_prov = CliProv::find($id);
        $cli_prov->nombre = $request->nombre;
        $cli_prov->fecha_antiguedad = $request->fecha_antiguedad;
        $cli_prov->tramo_actual_comision = $request->tramo_actual_comision;
        $cli_prov->save();

        return back()->with('notification', 'Registro guardado correctamente.');
    }
}
