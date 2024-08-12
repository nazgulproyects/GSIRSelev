<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Recogida;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ProductosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $productos = Productos::all();

        return view('productos.index')->with(compact('productos'));
    }

    public function create(Request $request)
    {
        $producto = new Productos();
        $producto->codigo = $request->codigo;
        $producto->descripcion = $request->descripcion;
        $producto->tipo = $request->tipo;
        $producto->unidad_medida = $request->unidad_medida;
        $producto->save();

        return back()->with('notification', 'Producto creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $producto = Productos::find($id);
        $producto->codigo = $request->codigo;
        $producto->descripcion = $request->descripcion;
        $producto->tipo = $request->tipo;
        $producto->unidad_medida = $request->unidad_medida;
        $producto->save();

        return back()->with('notification', 'Producto guardado correctamente.');
    }

    public function show($id)
    {
        $producto = Productos::find($id);

        return view('productos.show')->with(compact('producto'));
    }
    public function destroy(Request $request)
    {
        $producto = Productos::find($request->id_eliminar);
        $producto->delete();

        return back()->with('notification', 'Producto eliminado correctamente.');
    }
}
