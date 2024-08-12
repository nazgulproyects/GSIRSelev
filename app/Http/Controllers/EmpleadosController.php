<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class EmpleadosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $empleados = User::all();
        return view('empleados.empleados')->with(compact('empleados'));
    }

    public function create(Request $request)
    {
        $empleado = new User();
        $empleado->name = $request->name;
        $empleado->surname = $request->surname;
        $empleado->email = $request->email;
        $empleado->password = bcrypt($request->password);
        $empleado->tipo = $request->tipo;
        $empleado->save();

        return back()->with('notification', 'Empleado creado correctamente.');
    }

    public function show($empleado_id)
    {
        $empleado = User::find($empleado_id);
        return view('empleados.show')->with(compact('empleado'));
    }

    public function update(Request $request, $empleado_id)
    {
        $empleado = User::find($empleado_id);
        $empleado->name = $request->name;
        $empleado->surname = $request->surname;
        $empleado->email = $request->email;
        if ($request->password != null) $empleado->password = bcrypt($request->password);        
        $empleado->tipo = $request->tipo;
        $empleado->dni = $request->dni;
        $empleado->telefono = $request->telefono;
        $empleado->horasTotalesConduccion = $request->horasTotalesConduccion;
        $empleado->save();

        return back()->with('notification', 'Empleado actualizado correctamente.');
    }

    public function destroy(Request $request)
    {
        $empleado = User::find($request->id_eliminar);
        $empleado->delete();

        return back()->with('notification', 'Empleado eliminado correctamente.');
    }
}
