<?php

namespace App\Http\Controllers;

use App\Models\CliProv;
use App\Models\ContratoProductos;
use App\Models\Contratos;
use App\Models\Productos;
use App\Models\PuntoRecogida;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ContratosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $contratos = Contratos::all();
        $cli_provs = CliProv::all();
        $puntos_recogida = PuntoRecogida::all();
        return view('contratos.index')->with(compact('contratos', 'cli_provs', 'puntos_recogida'));
    }

    public function show($id)
    {
        $contrato = Contratos::find($id);
        $productos = Productos::all();
        $cli_provs = CliProv::all();
        $puntos_recogida = PuntoRecogida::all();
        $productos_contrato = ContratoProductos::where('contrato_id', $id)->get();

        return view('contratos.show')->with(compact('contrato', 'productos_contrato', 'productos', 'cli_provs', 'puntos_recogida'));
    }

    public function create(Request $request)
    {
        $contrato = new Contratos();
        $contrato->codigo = $request->codigo;
        $contrato->cli_prov_id = $request->cli_prov_id;
        $contrato->punto_recogida_id = $request->punto_recogida_id;
        $contrato->fecha_recogida_inicial = $request->fecha_recogida_inicial;
        $contrato->frecuencia = $request->frecuencia;
        $contrato->coste_unitario = $request->coste_unitario;
        $contrato->tipo = $request->tipo;
        $contrato->save();

        return back()->with('notification', 'Contrato creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $contrato = Contratos::find($id);
        $contrato->codigo = $request->codigo;
        $contrato->cli_prov_id = $request->cli_prov_id;
        $contrato->punto_recogida_id = $request->punto_recogida_id;
        $contrato->fecha_recogida_inicial = $request->fecha_recogida_inicial;
        $contrato->prox_dia_recogida = $request->prox_dia_recogida;
        $contrato->frecuencia = $request->frecuencia;
        $contrato->coste_unitario = $request->coste_unitario;
        $contrato->tipo = $request->tipo;
        $contrato->save();

        return back()->with('notification', 'Contrato guardado correctamente.');
    }

    public function destroy(Request $request)
    {
        $contrato = Contratos::find($request->id_eliminar);
        $contrato->delete();

        return back()->with('notification', 'Contrato eliminado correctamente.');
    }

    public function asginarProd(Request $request, $contrato_id)
    {
        $nuevo_prod_cont = new ContratoProductos();
        $nuevo_prod_cont->contrato_id = $contrato_id;
        $nuevo_prod_cont->producto_id = $request->producto_id;
        $nuevo_prod_cont->save();

        return back()->with('notification', 'Producto asignado correctamente.');
    }

    public function eliminar_prod(Request $request)
    {
        $cont_prod = ContratoProductos::find($request->id_eliminar);
        $cont_prod->delete();

        return back()->with('notification', 'Producto desasignado correctamente.');
    }

    public function pdf($id)
    {

        $contrato = Contratos::find($id);
        $data = [
            'id' => $id,
            'contrato' => $contrato
        ];

        // Renderiza la vista como un PDF
        $pdf = PDF::loadView('contratos.contrato_pdf', $data);

        // Descarga el PDF
        return $pdf->stream('contrato PDF.pdf');
    }
}
