<?php

namespace App\Http\Controllers;

use App\Models\Recogida;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class RecogidasController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $recogidas = Recogida::all();
        return view('recogidas.recogidas')->with(compact('recogidas'));
    }

    public function create(Request $request)
    {
        $recogidas = new Recogida();
        $recogidas->nombre = $request->nombre;
        $recogidas->save();

        return back()->with('notification', 'Recogida creada correctamente.');
    }

    public function destroy(Request $request)
    {
        $recogida = Recogida::find($request->id_eliminar);
        $recogida->delete();

        return back()->with('notification', 'Recogida eliminada correctamente.');
    }
}
