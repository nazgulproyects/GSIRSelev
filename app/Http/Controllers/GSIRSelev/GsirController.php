<?php

namespace App\Http\Controllers\GSIRSelev;

use App\Http\Controllers\Controller;
use App\Models\ImasD\imasd_cocina;
use App\Models\ImasD\imasd_recetas;
use Barryvdh\DomPDF\Facade as PDF;
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

  public function principal(Request $request)
  {
    
    $datos = DB::connection('mavaser')->table('dbo.MAVASER, S_L_$Sales Comment Line')->get();

    dd($datos);

    $empresa = $request->empresa;
    session(['empresa' => $empresa]);

    return view('GSIRSelev.principal')->with(compact('empresa'));
  }

  public function principal_get()
  {
    return view('GSIRSelev.principal');
  }

  public function rutas()
  {

    $rutas = [
      [
        'id' => 1,
        'nombre' => 'RDR22/000766',
        'desc' => 'CONSUM, S. COOP. V. (BETXI-Vilavella)',
        'direccion' => 'Direccion entrega 1',
        'estado' => 'COMPLETADO',

      ], [
        'id' => 2,
        'nombre' => 'RDR22/000767',
        'desc' => 'CONSUM, S. COOP. V. (BETXI-Vilavella)',
        'direccion' => 'Direccion entrega 2',
        'estado' => 'COMPLETADO'

      ], [
        'id' => 3,
        'nombre' => 'RDR22/000768',
        'desc' => 'CONSUM, S. COOP. V. (BETXI-Vilavella)',
        'direccion' => 'Direccion entrega 3',
        'estado' => 'PENDIENTE DESCARGA'

      ], [
        'id' => 4,
        'nombre' => 'RDR22/000769',
        'desc' => 'CONSUM, S. COOP. V. (BETXI-Vilavella)',
        'direccion' => 'Direccion entrega 4',
        'estado' => 'PENDIENTE'

      ]
    ];

    return view('GSIRSelev.rutas')->with(compact('rutas'));
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

  public function vehiculos()
  {

    $vehiculos = [
      [
        'id' => 1,
        'matricula' => '1234AAA'
      ], [
        'id' => 2,
        'matricula' => '4125HRD',
      ],  [
        'id' => 3,
        'matricula' => '5324JYT',

      ], [
        'id' => 4,
        'matricula' => '1424HJT',
      ]

    ];

    return view('GSIRSelev.vehiculos')->with(compact('vehiculos'));
  }

  public function pdf_albaran($id)
  {
    $data = [
      'id' => $id
    ];

    return PDF::loadView('GSIRSelev.pdf_albaran', $data)->stream('informe_bonificacion.pdf');
  }

  public function planta()
  {

    $vehiculos_pend = [
      [
        'id' => 1,
        'vehiculo' => '1234AAA',
        'ruta' => 'RDR22/000774',
        'fecha' => '24/03/2024 12:32',
        'cond' => 'EDUARDO VERNIA MERINO',
        'peso' => 14706
      ], [
        'id' => 2,
        'vehiculo' => '4125HRD',
        'ruta' => 'RDR22/000775',
        'fecha' => '24/03/2024 15:45',
        'cond' => 'JUAN GARCÍA PEREZ',
        'peso' => 12640
      ]

    ];

    return view('GSIRSelev.planta')->with(compact('vehiculos_pend'));
  }
}
