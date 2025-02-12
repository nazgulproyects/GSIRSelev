<?php

namespace App\Http\Controllers\GSIRSelev;

use App\Http\Controllers\Controller;
use App\Models\ImasD\imasd_cocina;
use App\Models\ImasD\imasd_recetas;
use App\Models\PendientesDescarga;
use App\Models\ProductosAdicionales;
use App\Models\ProductosPuntos;
use App\Models\PuntoRecogida;
use App\Models\Ruta;
use App\Models\User;
use App\Models\VehiculosRuta;
use App\Services\GeneralService;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
      'id' => $id,
      'ruta_id' => $pto_recogida->ruta_id
    ];

    return PDF::loadView('GSIRSelev.pdf_albaran', $data)->stream('informe_bonificacion.pdf');
  }

  public function di_pdf()
  {

    $data = [
      'id' => '2'
    ];

    return PDF::loadView('GSIRSelev.documentos.prueba', $data)->stream('prueba.pdf');
  }

  public function ad_pdf()
  {

    $data = [
      'id' => '2'
    ];

    return PDF::loadView('GSIRSelev.documentos.prueba2', $data)->stream('prueba2.pdf');
  }

  /**
   * Generar el pdf del documento comercial
   */
  public function doc_comercial_pdf($ruta, $pto_web_id)
  {

    $Lin_ = '$Lin_';
    $f4e2b823 = '$f4e2b823';
    $Item = '$Item$f4e2b823';
    $Customer = '$Customer';
    $Conductor = '$Conductor$f4e2b823';
    $Vendor = '$Vendor';

    $cod_conductor = auth()->user()->cod_conductor;

    if (auth()->user()->empresa == 'SELEV') {
      $datos_ruta = DB::connection('mavaser')->select("
        SELECT
          [No_ ruta]
          ,[No_ linea]     
          ,[No_ Proveedor_Cliente]
          ,[Nombre]
          ,[Direccion 1]
          ,[Direccion 2]
          ,[Poblacion]
          ,[No_ telefono]
          ,[C_P_]
          ,[Provincia]
          ,[No_ producto]
          ,[Descripcion producto]
          ,CASE T.[Especie]
                WHEN 0 THEN ''
                WHEN 1 THEN 'Mixta'
                WHEN 2 THEN 'Porcino'
                WHEN 3 THEN 'Avícola'
                WHEN 4 THEN 'Vacuno'
                WHEN 5 THEN 'Ovino-Caprino'
                WHEN 6 THEN 'Cunícola'
                WHEN 7 THEN 'Equino'
                WHEN 8 THEN 'Pescado'
          END AS Especie
                      ,CASE T.[Tipo]
                WHEN 0 THEN '<'
                WHEN 1 THEN 'Materia prima'
                WHEN 2 THEN 'Semielaborado'
                WHEN 3 THEN 'Producto final'
                WHEN 4 THEN 'Aditivo'
                WHEN 5 THEN 'Producto Adicional'
                WHEN 6 THEN 'Grasa para reproceso'
          END AS Tipo
                      ,T.[Cod_ familia]
          ,[Bascula propia]
          ,L.[Tolva entrada]   
          ,[Cod_ Proveedor Asociado]   
          ,[Tolva Origen]
          ,[A convertir en Destino]
          ,[Empresa origen]
          ,[Empresa destino]
          ,[No_ ruta original]
          ,[No_ linea original]
          ,[Observaciones]
          ,[Productos adicionales]
          ,[Forma de pago]
          ,[Nº Tienda]
          ,[Grupo]
        FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208] AS L
        INNER JOIN [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Item-5811-49c6-a41c-7c9707074208] AS T ON T.No_=L.[No_ producto]
        WHERE [No_ ruta]='$ruta'
      ");
      $cliente = $datos_ruta[0]->{'No_ Proveedor_Cliente'};
      $datos_cliente = DB::connection('mavaser')->select("
        SELECT [No_]
        ,[Name]
        ,[VAT Registration No_]
        FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Customer] WHERE No_ = '$cliente'
      ");
      $datos_conductor = DB::connection('mavaser')->select("select * FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Conductor-5811-49c6-a41c-7c9707074208] WHERE [Cod_ Conductor] = '$cod_conductor'");
      $prov_empresa_transporte = $datos_conductor[0]->{'Cod_ empresa transporte'};
      $datos_empresa_transporte = DB::connection('mavaser')->select("select Name, Address, City, [Post Code] FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Vendor] WHERE No_ = '$prov_empresa_transporte'");
    } else if (auth()->user()->empresa == 'REMITTEL') {
      $datos_ruta = DB::connection('mavaser')->select("
        SELECT
          [No_ ruta]
          ,[No_ linea]     
          ,[No_ Proveedor_Cliente]
          ,[Nombre]
          ,[Direccion 1]
          ,[Direccion 2]
          ,[Poblacion]
          ,[No_ telefono]
          ,[C_P_]
          ,[Provincia]
          ,[No_ producto]
          ,[Descripcion producto]
          ,CASE T.[Especie]
                WHEN 0 THEN ''
                WHEN 1 THEN 'Mixta'
                WHEN 2 THEN 'Porcino'
                WHEN 3 THEN 'Avícola'
                WHEN 4 THEN 'Vacuno'
                WHEN 5 THEN 'Ovino-Caprino'
                WHEN 6 THEN 'Cunícola'
                WHEN 7 THEN 'Equino'
                WHEN 8 THEN 'Pescado'
          END AS Especie
                      ,CASE T.[Tipo]
                WHEN 0 THEN '<'
                WHEN 1 THEN 'Materia prima'
                WHEN 2 THEN 'Semielaborado'
                WHEN 3 THEN 'Producto final'
                WHEN 4 THEN 'Aditivo'
                WHEN 5 THEN 'Producto Adicional'
                WHEN 6 THEN 'Grasa para reproceso'
          END AS Tipo
                      ,T.[Cod_ familia]
          ,[Bascula propia]
          ,L.[Tolva entrada]   
          ,[Cod_ Proveedor Asociado]   
          ,[Tolva Origen]
          ,[A convertir en Destino]
          ,[Empresa origen]
          ,[Empresa destino]
          ,[No_ ruta original]
          ,[No_ linea original]
          ,[Observaciones]
          ,[Productos adicionales]
          ,[Forma de pago]
          ,[Nº Tienda]
          ,[Grupo]
        FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208] AS L
        INNER JOIN [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Item-5811-49c6-a41c-7c9707074208] AS T ON T.No_=L.[No_ producto]
        WHERE [No_ ruta]='$ruta'
      ");
      $cliente = $datos_ruta[0]->{'No_ Proveedor_Cliente'};
      $datos_cliente = DB::connection('mavaser')->select("
        SELECT [No_]
        ,[Name]
        ,[VAT Registration No_]
        FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Customer] WHERE No_ = '$cliente'
      ");
      $datos_conductor = DB::connection('mavaser')->select("select * FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Conductor-5811-49c6-a41c-7c9707074208] WHERE [Cod_ Conductor] = '$cod_conductor'");
      $prov_empresa_transporte = $datos_conductor[0]->{'Cod_ empresa transporte'};
      $datos_empresa_transporte = DB::connection('mavaser')->select("select Name, Address, City, [Post Code] FROM [SELEV_BC].[dbo].[REMITTEL 2017, S_L_$Vendor] WHERE No_ = '$prov_empresa_transporte'");
    }

    $vehiculo_ruta = VehiculosRuta::where('cod_ruta', $ruta)->orderby('id', 'desc')->first();

    $productos_punto = ProductosPuntos::where('punto_recogida_id', $pto_web_id)->get();
    $cant_entregados = ProductosAdicionales::where('punto_recogida_id', $pto_web_id)->where('tipo', 'DEJAR')->sum('cantidad');
    $cant_recogidos = ProductosAdicionales::where('punto_recogida_id', $pto_web_id)->where('tipo', 'RECOGER')->sum('cantidad');

    $fechaActual = Carbon::now()->locale('es')->translatedFormat('j \d\e F \d\e Y');
    $data = [
      'datos_ruta' => $datos_ruta[0],
      'productos_punto' => $productos_punto,
      'fechaActual' => $fechaActual,
      'cant_entregados' => $cant_entregados,
      'cant_recogidos' => $cant_recogidos,
      'cif_nif' => $datos_cliente[0]->{'VAT Registration No_'},
      'datos_conductor' => $datos_conductor[0],
      'vehiculo_ruta' => $vehiculo_ruta,
      'datos_empresa_transporte' => $datos_empresa_transporte[0]
    ];

    return PDF::loadView('GSIRSelev.documentos.doc_comercial', $data)->stream('doc_comercial.pdf');
  }
}
