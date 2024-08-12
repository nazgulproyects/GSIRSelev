<?php

namespace App\Http\Controllers;

use App\Models\ContratoProductos;
use App\Models\Contratos;
use App\Models\Recogida;
use App\Models\Ruta;
use App\Models\RutasPuntosRecogida;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class AppConductorController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $hoy = new DateTime();
        $rutas_dia = Ruta::where('usuario_id', auth()->user()->id)->whereDate('fecha', $hoy)->get();

        return view('app_conductor.rutas_conductor')->with(compact('rutas_dia'));
    }


    /**
     * Mostar una ruta en la app de conductor
     */
    public function show($ruta_id)
    {
        $ruta = Ruta::find($ruta_id);
        $puntos_ruta = RutasPuntosRecogida::where('ruta_id', $ruta_id)->get();
        return view('app_conductor.estado_ruta')->with(compact('ruta', 'puntos_ruta'));
    }

    public function productos_pr(Request $request)
    {
        $puntos_ruta = RutasPuntosRecogida::find($request->ruta_pr_id);

        $contrato = Contratos::where('punto_recogida_id', $puntos_ruta->punto_recogida_id)->first();
        $productos_contrato = ContratoProductos::where('contrato_id', $contrato->id)->get();
        $productos = [];
        foreach ($productos_contrato as $prod_cont) {
            array_push($productos, $prod_cont->producto);
        }
        return response()->json($productos);
    }

    public function guardar_albaran(Request $request)
    {

        $image_64 = $request->get('imgBase64'); //your base64 encoded data
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        // find substring fro replace here eg: data:image/png;base64,

        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);

        $imageName = 'firma_.' . $extension;
        Storage::disk('firmas')->put($imageName, base64_decode($image));
        $url = Storage::url('firmas/' . $imageName);


        // $relacion_entrega = prl_entrega_epis::find($entregaId);
        // $relacion_entrega->firma = $url;
        // $relacion_entrega->save();


        return 'OK';
    }
}
