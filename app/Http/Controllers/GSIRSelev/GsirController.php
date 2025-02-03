<?php

namespace App\Http\Controllers\GSIRSelev;

use App\Http\Controllers\Controller;
use App\Models\ImasD\imasd_cocina;
use App\Models\ImasD\imasd_recetas;
use App\Models\PendientesDescarga;
use App\Models\PuntoRecogida;
use App\Models\User;
use App\Services\GeneralService;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GsirController extends Controller
{

  public function gsir_selev()
  {
    return view('GSIRSelev.login');
  }

  public function empresa(Request $request)
  {
   
    return view('GSIRSelev.empresa');
  }

  public function empresa_back()
  {
    return view('selector_empresa');
  }

  public function principal(Request $request, GeneralService $service)
  {
   
    $codigo_cond = $service->codigoConductor();
   
    $usuario = User::find(auth()->user()->id);
    $usuario->cod_conductor = $codigo_cond;
    $usuario->save();


    $empresa = $request->empresa;
    session(['empresa' => $empresa]);

    $num_desc_pend = PendientesDescarga::where('estado', 'PENDIENTE')->count();


    return view('GSIRSelev.principal')->with(compact('empresa', 'num_desc_pend'));
  }

  public function principal_get()
  {
    $num_desc_pend = PendientesDescarga::where('estado', 'PENDIENTE')->count();

    return view('GSIRSelev.principal')->with(compact('num_desc_pend'));
  }



  public function ruta_info($id)
  {

    $ruta = [];

    $vehiculos = [
      '0000AAA',
      '1111BBB',
      '2222CCC',
      '3333DDD',

    ];

    $puntos_recogida = [
      [
        'id' => 1,
        'nombre' => 'Punto 1',
        'direccion' => 'Direccion entrega 1',
        'estado' => 'COMPLETADO',

      ], [
        'id' => 2,
        'nombre' => 'Punto 2',
        'direccion' => 'Direccion entrega 2',
        'estado' => 'COMPLETADO'

      ], [
        'id' => 3,
        'nombre' => 'Punto 3',
        'direccion' => 'Direccion entrega 3',
        'estado' => 'EN PROCESO'

      ], [
        'id' => 4,
        'nombre' => 'Punto 4',
        'direccion' => 'Direccion entrega 4',
        'estado' => 'PENDIENTE'

      ]

    ];

    return view('GSIRSelev.ruta_info')->with(compact('ruta', 'puntos_recogida', 'vehiculos'));
  }

  public function ruta_pto_recogida_info($id)
  {
    $pto_recogida = [
      'id' => 1,
      'nombre' => 'Nombre Pto Recogida'
    ];

    $productos = [
      [
        'id' => 1,
        'peso' => '1000',
        'num_linea' => '10000',
        'desc_prod' => 'GRASA/HUESO GRAN SUPERFICIE'
      ], [
        'id' => 2,
        'peso' => '1250',
        'num_linea' => '20000',
        'desc_prod' => 'PESCADO GRANDES SUPERFICIES'
      ],

    ];

    return view('GSIRSelev.ruta_pto_recogida')->with(compact('pto_recogida', 'productos'));
  }

  public function gastos()
  {

    $gastos = [
      [
        'id' => 1,
        'fecha' => '10/09/2024',
        'tipo' => 'DIETA',
        'coste' => '8'
      ], [
        'id' => 2,
        'fecha' => '09/09/2024',
        'tipo' => 'HOSPEDAJE',
        'coste' => '70'
      ],  [
        'id' => 3,
        'fecha' => '08/09/2024',
        'tipo' => 'COMBUSTIBLE',
        'coste' => '30',

      ], [
        'id' => 4,
        'fecha' => '08/09/2024',
        'tipo' => 'DIETA',
        'coste' => '10'

      ]

    ];


    return view('GSIRSelev.gastos')->with(compact('gastos'));
  }



  public function pdf_albaran($id)
  {

    // Cambiamos el estado del punto de recogida a 'FINALIZADO'
    $pto_recogida = PuntoRecogida::find($id);
    $pto_recogida->estado = 'FINALIZADO';
    $pto_recogida->save();

    $data = [
      'id' => $id
    ];

    return PDF::loadView('GSIRSelev.pdf_albaran', $data)->stream('informe_bonificacion.pdf');
  }


}
