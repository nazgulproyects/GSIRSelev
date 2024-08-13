<?php

namespace App\Http\Controllers;

use App\Models\Albaranes;
use App\Models\AlbaranProductos;
use App\Models\CliProv;
use App\Models\Costes;
use App\Models\Mantenimientos;
use App\Models\Productos;
use App\Models\Recogida;
use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AlbaranesController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $albaranes = Albaranes::all();
        $cli_provs = CliProv::all();
        return view('albaranes.index')->with(compact('albaranes', 'cli_provs'));
    }

    public function create(Request $request)
    {
        $albaran = new Albaranes();
        $albaran->fecha = $request->fecha;
        $albaran->cliente = $request->cli_prov_id;
        $albaran->save();

        return back()->with('notification', 'Albarán creado correctamente.');
    }

    public function show($id)
    {
        $albaran = Albaranes::find($id);
        $productos = Productos::all();
        $albaran_prods = AlbaranProductos::where('albaran_id', $id)->get();
        $cli_provs = CliProv::all();

        return view('albaranes.show')->with(compact('albaran', 'productos', 'cli_provs', 'albaran_prods'));
    }

    public function asginarProd(Request $request, $albaran_id)
    {
        $nuevo_prod_alb = new AlbaranProductos();
        $nuevo_prod_alb->albaran_id = $albaran_id;
        $nuevo_prod_alb->producto_id = $request->producto_id;
        $nuevo_prod_alb->cantidad = $request->cantidad;
        $nuevo_prod_alb->save();

        return back()->with('notification', 'Producto asignado correctamente.');
    }

    public function pdf($id)
    {
        $albaran = Albaranes::find($id);
        $albaran_prods = AlbaranProductos::where('albaran_id', $id)->get();
        $data = [
            'id' => $id,
            'albaran' => $albaran,
            'albaran_prods' => $albaran_prods
        ];

        // Renderiza la vista como un PDF
        $pdf = PDF::loadView('albaranes.albaran_pdf', $data);

        // Descarga el PDF
        return $pdf->stream('albaranes PDF.pdf');
    }

}
