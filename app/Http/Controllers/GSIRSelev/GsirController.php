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
    $Vendor2 = '$Vendor$f4e2b823';
    $Vehiculo2 = '$Vehiculo$f4e2b823';
    $Ruta = '$Ruta';

    $cod_conductor = auth()->user()->cod_conductor;

    $empresa = auth()->user()->empresa;
    //$empresa = 'SELEV';
    $fechaActual = now()->format('d.m.Y');
    //$fechaActual = '13.02.2025';
    $lugar_recogida = '';


    // DATOS DEL TRANSPORTE
    $empresa_transporte = '';
    $direccion_transporte = '';
    $municipio_transporte = '';
    $cp_transporte = '';
    $num_autoriz = '';
    if ($empresa == 'SELEV') {

      $ruta_nav = DB::connection(SELEV_BC)->select("
        SELECT [No_ ruta diaria]
        ,[Descripcion]
        ,[Fecha emision ruta]
        ,[Kms_ ruta]
        ,[Cod_ conductor]
        ,[Nombre conductor]
        ,[Cod_ empresa transporte]
        ,[Nombre empresa transporte]
        ,P1.[No_ Autorizac_ Transportista] AS NAutorizacion
        ,P.Address AS Direccionproveedor
        ,P.City AS Municipioproveedor
        ,P.[Post Code] AS Codpostalproveedor
        ,[Cod_ vehiculo]
        ,[Cod_ Remolque 1]
        ,[Cod_ Remolque 2]
        ,[Bloquear]
        ,[Tolva Entrada]    
        ,[Ruta secundaria]
        ,[Ruta principal]
        ,[Ruta de Gestion Externa]
        FROM [SELEV_BC].[dbo].[" . SELEV_SQL . "$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208] AS R
        LEFT JOIN [SELEV_BC].[dbo].[" . SELEV_SQL . "$Vendor2-5811-49c6-a41c-7c9707074208] AS P1 ON P1.No_=R.[Cod_ empresa transporte]
        left JOIN [SELEV_BC].[dbo].[" . SELEV_SQL . "$Vendor] AS P ON P.No_=R.[Cod_ empresa transporte]
        WHERE [Fecha emision ruta] = '$fechaActual' and [Cod_ conductor]='$cod_conductor'
      ");

      $nombre_empresa_transporte = $ruta_nav[0]->{'Nombre empresa transporte'};
      // ! Estos remolque son los que ponga en Navision o los que haya guardados en la app de nsir ?
      $remolque1 = $ruta_nav[0]->{'Cod_ Remolque 1'};
      $remolque2 = $ruta_nav[0]->{'Cod_ Remolque 2'};


      // ====================================== DATOS DEL TRANSPORTISTA ======================================
      // Si el campo cod_ empresa transporte esta informado, es que el transporte lo hace un tercero, pero hay que comprobar que no sea ningun remolque de Selev, sinos sera selev
      if ($ruta_nav[0]->{'Cod_ empresa transporte'} != "") {

        $propiedad_selev_r1 = DB::connection(SELEV_BC)->select("select [Cod_ vehiculo] FROM [SELEV_BC].[dbo].[" . SELEV_SQL . "$Vehiculo2-5811-49c6-a41c-7c9707074208] where Remolque=1 and Baja=0 and [Tipo vehiculo]=0 and App=1 and [Cod_ vehiculo]='$remolque1'");
        if (sizeof($propiedad_selev_r1) == 0) { // Si el remolque1 no es de selev, vemos si es el remolque2
          $propiedad_selev_r2 = DB::connection(SELEV_BC)->select("select [Cod_ vehiculo] FROM [SELEV_BC].[dbo].[" . SELEV_SQL . "$Vehiculo2-5811-49c6-a41c-7c9707074208] where Remolque=1 and Baja=0 and [Tipo vehiculo]=0 and App=1 and [Cod_ vehiculo]='$remolque2'");
          if (sizeof($propiedad_selev_r2) == 0) { // El transporte es de un TERCERO

            // Aqui sí, buscamos en vendor el codigo que ponga
            dd('El cliente es un tercero.');
          } else { // El transporte es SELEV
            $empresa_transporte = 'SELEV Pet Industry, S.L.U.';
            $direccion_transporte = 'Autovía A-7 Km. 356';
            $municipio_transporte = 'Silla';
            $cp_transporte = 'ES-46460';
          }
        } else { // El transporte es SELEV
          $empresa_transporte = 'SELEV Pet Industry, S.L.U.';
          $direccion_transporte = 'Autovía A-7 Km. 356';
          $municipio_transporte = 'Silla';
          $cp_transporte = 'ES-46460';
        }
      } else { // Si esta en blanco, la empresa de t4ransporte es la misma (SELEV o REMITTEL)


        // Aqui vemos si alguno de los dos remolque es de Selev, si es así, aunque ponga cualquier otra cosa en nombre empresa transporte, siempre será Selev.
        if ($nombre_empresa_transporte == 'SELEV Pet Industry, S.L.U.') { // El transporte es SELEV

          $empresa_transporte = 'SELEV Pet Industry, S.L.U.';
          $direccion_transporte = 'Autovía A-7 Km. 356';
          $municipio_transporte = 'Silla';
          $cp_transporte = 'ES-46460';
        } else if ($nombre_empresa_transporte == 'REMITTEL 2017, S.L.U.' || $nombre_empresa_transporte == 'TEST_REMITTEL 2017, S.L.') { // El transporte es REMITTEL

          $empresa_transporte = 'REMITTEL 2017, S.L.U.';
          $direccion_transporte = 'C/Jose Perez Llácer Nº 10 pta. 1 edif.AS Center';
          $municipio_transporte = 'Alfafar';
          $cp_transporte = 'ES-46910';
        } else { // En este caso vemos si alguno de los dos remolques son de Selev, de ser así, el DATO TRANSPORTE será Selev

          $propiedad_selev_r1 = DB::connection(SELEV_BC)->select("select [Cod_ vehiculo] FROM [SELEV_BC].[dbo].[" . SELEV_SQL . "$Vehiculo2-5811-49c6-a41c-7c9707074208] where Remolque=1 and Baja=0 and [Tipo vehiculo]=0 and App=1 and [Cod_ vehiculo]='$remolque1'");
          if (sizeof($propiedad_selev_r1) == 0) { // Si el remolque1 no es de selev, vemos si es el remolque2
            $propiedad_selev_r2 = DB::connection(SELEV_BC)->select("select [Cod_ vehiculo] FROM [SELEV_BC].[dbo].[" . SELEV_SQL . "$Vehiculo2-5811-49c6-a41c-7c9707074208] where Remolque=1 and Baja=0 and [Tipo vehiculo]=0 and App=1 and [Cod_ vehiculo]='$remolque2'");
            if (sizeof($propiedad_selev_r2) == 0) { // El transporte es de un TERCERO
              // Aqui sí, buscamos en vendor el codigo que ponga
              dd('El cliente es un tercero.');
            } else { // El transporte es SELEV
              $empresa_transporte = 'SELEV Pet Industry, S.L.U.';
              $direccion_transporte = 'Autovía A-7 Km. 356';
              $municipio_transporte = 'Silla';
              $cp_transporte = 'ES-46460';
            }
          } else { // El transporte es SELEV
            $empresa_transporte = 'SELEV Pet Industry, S.L.U.';
            $direccion_transporte = 'Autovía A-7 Km. 356';
            $municipio_transporte = 'Silla';
            $cp_transporte = 'ES-46460';
          }
        }
      }

      $punt_rec_actual = PuntoRecogida::where('id', $pto_web_id)->first();
      $cli_prov_punto = $punt_rec_actual->no_prov_cli;
      $datos_ruta = DB::connection(SELEV_BC)->select("
        SELECT
        [No_ ruta]
        ,[No_ linea]
        ,P.[VAT Registration No_] AS CIF
        ,P1.[No_ Autorizac_ Transportista] AS NAutorizacion
        ,P.Address AS Direccionproveedor
        ,P.City AS Municipioproveedor
        ,P.[Post Code] AS Codpostalproveedor
        ,[No_ Proveedor_Cliente]
        ,[Nombre]
        ,[Direccion 1] AS Direccionrecogida
        ,[Direccion 2]
        ,[Poblacion] AS Municipiorecogida
        ,[No_ telefono]
        ,[C_P_] AS Codpostalrecogida
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
        ,L.[Bascula propia]
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
        ,P1.[Actividad]
          FROM [SELEV_BC].[dbo].[" . SELEV_SQL . "$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208] AS L
          INNER JOIN [SELEV_BC].[dbo].[" . SELEV_SQL . "$Item-5811-49c6-a41c-7c9707074208] AS T ON T.No_=L.[No_ producto]
          LEFT JOIN [SELEV_BC].[dbo].[" . SELEV_SQL . "$Vendor] AS P ON P.No_=
          (case substring(L.[No_ Proveedor_Cliente],1,1)
          when 'P' then L.[No_ Proveedor_Cliente]
          when 'C' then ('PR'+ substring(L.[No_ Proveedor_Cliente],3,5))
          end)
        LEFT JOIN [SELEV_BC].[dbo].[" . SELEV_SQL . "$Vendor2-5811-49c6-a41c-7c9707074208] as P1 ON P1.No_ =
          (case substring(L.[No_ Proveedor_Cliente],1,1)
          when 'P' then L.[No_ Proveedor_Cliente]
          when 'C' then ('PR'+ substring(L.[No_ Proveedor_Cliente],3,5))
          end)
        WHERE [No_ ruta]='$ruta'

      ");

      $datos_conductor = DB::connection(SELEV_BC)->table(SELEV_Conductores)->where('Cod_ Conductor', $cod_conductor)->get();

      // $prov_empresa_transporte = $datos_conductor[0]->{'Cod_ empresa transporte'};
      // $datos_empresa_transporte = DB::connection(SELEV_BC)->select("select Name, Address, City, [Post Code] FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Vendor] WHERE No_ = '$prov_empresa_transporte'");



      // ====================================== DATOS DEL DESTINO ======================================
      $nombre_destino = '';
      $cif_destino = '';
      $num_autorizacion_destino = '';
      $direccion_destino = '';
      $municipio_destino = '';
      $cp_destino = '';

      $actividad_destino = '';
      if ($datos_ruta[0]->Actividad == 1) {
        $actividad_destino = 'Planta Intermedia';
      } else if ($datos_ruta[0]->Actividad == 2) {
        $actividad_destino = 'Planta Transformadora';
      }
      $tolva_entrada = $ruta_nav[0]->{'Tolva Entrada'};
      $lista_tolvas_selev = ['TC-IN-CAM', 'TC-IN-ORGA', 'TC-IN-PS1', 'TC-IN-PS2', 'TC-INTER', 'TC-PA1', 'TC-PA2', 'TC-PESCADO', 'TC-PP1', 'TC-PS1', 'TC-PS2', 'TC-PSH1'];

      if (in_array($tolva_entrada, $lista_tolvas_selev)) {
        $nombre_destino = 'SELEV PET INDUSTRY, S.L.';
        $cif_destino = 'B46062071';
        $num_autorizacion_destino = 'SANDACH S46230001';
        $direccion_destino = 'AUTOVIA A-7 KM. 356';
        $municipio_destino = 'Silla';
        $cp_destino = 'ES-46460';
      } else {

        $Location = '$Location$f4e2b823';
        $datos_destino = DB::connection(SELEV_BC)->select("
          SELECT 
            P.Name
            ,P.[VAT Registration No_]
            ,P1.[No_ Autorizac_ Transportista] AS NAutorizacion
            ,P.Address AS Direccionproveedor
            ,P.City AS Municipioproveedor
            ,P.[Post Code] AS Codpostalproveedor
          FROM [SELEV_BC].[dbo].[" . SELEV_SQL . "$Location-5811-49c6-a41c-7c9707074208] as L
          LEFT JOIN [SELEV_BC].[dbo].[" . SELEV_SQL . "$Vendor] AS P ON P.No_=L.[Proveedor Asociado]
          LEFT JOIN [SELEV_BC].[dbo].[" . SELEV_SQL . "$Vendor2-5811-49c6-a41c-7c9707074208] AS P1 ON P1.No_=L.[Proveedor Asociado]
          WHERE L.Code='$tolva_entrada'
        ");
        $nombre_destino = $datos_destino[0]->Name;
        $cif_destino = $datos_destino[0]->{'VAT Registration No_'};
        $num_autorizacion_destino = $datos_destino[0]->NAutorizacion;
        $direccion_destino = $datos_destino[0]->Direccionproveedor;
        $municipio_destino = $datos_destino[0]->Municipioproveedor;
        $cp_destino = $datos_destino[0]->Codpostalproveedor;
      }
    } else if ($empresa == 'REMITTEL') {


      $ruta_nav = DB::connection(SELEV_BC)->select("
        SELECT  *
        FROM [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208] AS R
        LEFT JOIN [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vendor2-5811-49c6-a41c-7c9707074208] AS P1 ON P1.No_=R.[Cod_ empresa transporte]
        left JOIN [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vendor] AS P ON P.No_=R.[Cod_ empresa transporte]
        WHERE [Fecha emision ruta] = '$fechaActual' and [Cod_ conductor]='$cod_conductor' and [No_ ruta diaria] = '$ruta'
      ");

      $nombre_empresa_transporte = $ruta_nav[0]->{'Nombre empresa transporte'};
      // ! Estos remolque son los que ponga en Navision o los que haya guardados en la app de nsir ?
      $remolque1 = $ruta_nav[0]->{'Cod_ Remolque 1'};
      $remolque2 = $ruta_nav[0]->{'Cod_ Remolque 2'};

      // ====================================== DATOS DEL TRANSPORTISTA ======================================
      // Si el campo cod_ empresa transporte esta informado, es que el transporte lo hace un tercero, pero hay que comprobar que no sea ningun remolque de Selev, sinos sera selev
      if ($ruta_nav[0]->{'Cod_ empresa transporte'} != "") {

        $propiedad_selev_r1 = DB::connection(SELEV_BC)->select("select [Cod_ vehiculo] FROM [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vehiculo2-5811-49c6-a41c-7c9707074208] where Remolque=1 and Baja=0 and [Tipo vehiculo]=0 and App=1 and [Cod_ vehiculo]='$remolque1'");
        if (sizeof($propiedad_selev_r1) == 0) { // Si el remolque1 no es de selev, vemos si es el remolque2
          $propiedad_selev_r2 = DB::connection(SELEV_BC)->select("select [Cod_ vehiculo] FROM [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vehiculo2-5811-49c6-a41c-7c9707074208] where Remolque=1 and Baja=0 and [Tipo vehiculo]=0 and App=1 and [Cod_ vehiculo]='$remolque2'");
          if (sizeof($propiedad_selev_r2) == 0) { // El transporte es de un TERCERO

            $prov_empresa_transporte = $ruta_nav[0]->{'Cod_ empresa transporte'};
            $datos_empresa_transporte = DB::connection(SELEV_BC)->select("select Name, Address, City, [Post Code] FROM [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vendor] WHERE No_ = '$prov_empresa_transporte'");
            $datos_empresa_transporte2 = DB::connection(SELEV_BC)->select("select * FROM [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vendor2-5811-49c6-a41c-7c9707074208] WHERE No_ = '$prov_empresa_transporte'");

            $empresa_transporte = $datos_empresa_transporte[0]->Name;
            $direccion_transporte = $datos_empresa_transporte[0]->Address;
            $municipio_transporte = $datos_empresa_transporte[0]->City;
            $cp_transporte = $datos_empresa_transporte[0]->{'Post Code'};
            $num_autoriz = $datos_empresa_transporte2[0]->{'No_ Autorizac_ Transportista'};
          } else { // El transporte es SELEV
            $empresa_transporte = 'SELEV Pet Industry, S.L.U.';
            $direccion_transporte = 'Autovía A-7 Km. 356';
            $municipio_transporte = 'Silla';
            $cp_transporte = 'ES-46460';
          }
        } else { // El transporte es SELEV
          $empresa_transporte = 'SELEV Pet Industry, S.L.U.';
          $direccion_transporte = 'Autovía A-7 Km. 356';
          $municipio_transporte = 'Silla';
          $cp_transporte = 'ES-46460';
        }
      } else { // Si esta en blanco, la empresa de t4ransporte es la misma (SELEV o REMITTEL)

        // Aqui vemos si alguno de los dos remolque es de Selev, si es así, aunque ponga cualquier otra cosa en nombre empresa transporte, siempre será Selev.
        if ($nombre_empresa_transporte == 'SELEV Pet Industry, S.L.U.') { // El transporte es SELEV

          $empresa_transporte = 'SELEV Pet Industry, S.L.U.';
          $direccion_transporte = 'Autovía A-7 Km. 356';
          $municipio_transporte = 'Silla';
          $cp_transporte = 'ES-46460';
        } else if ($nombre_empresa_transporte == 'REMITTEL 2017, S.L.U.' || $nombre_empresa_transporte == 'TEST_REMITTEL 2017, S.L.') { // El transporte es REMITTEL
          $empresa_transporte = 'REMITTEL 2017, S.L.U.';
          $direccion_transporte = 'C/ José Pérez Llácer n 10 Pta. 1 Edif. As Center';
          $municipio_transporte = 'ALFAFAR';
          $cp_transporte = 'ES-46910';
          $num_autoriz = 'S46022003';
        } else { // En este caso vemos si alguno de los dos remolques son de Selev, de ser así, el DATO TRANSPORTE será Selev

          $propiedad_selev_r1 = DB::connection(SELEV_BC)->select("select [Cod_ vehiculo] FROM [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vehiculo2-5811-49c6-a41c-7c9707074208] where Remolque=1 and Baja=0 and [Tipo vehiculo]=0 and App=1 and [Cod_ vehiculo]='$remolque1'");
          if (sizeof($propiedad_selev_r1) == 0) { // Si el remolque1 no es de selev, vemos si es el remolque2
            $propiedad_selev_r2 = DB::connection(SELEV_BC)->select("select [Cod_ vehiculo] FROM [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vehiculo2-5811-49c6-a41c-7c9707074208] where Remolque=1 and Baja=0 and [Tipo vehiculo]=0 and App=1 and [Cod_ vehiculo]='$remolque2'");
            if (sizeof($propiedad_selev_r2) == 0) { // El transporte es de un TERCERO
              // Aqui sí, buscamos en vendor el codigo que ponga
              dd('El cliente es un tercero 2.');
            } else { // El transporte es SELEV
              $empresa_transporte = 'SELEV Pet Industry, S.L.U.';
              $direccion_transporte = 'Autovía A-7 Km. 356';
              $municipio_transporte = 'Silla';
              $cp_transporte = 'ES-46460';
            }
          } else { // El transporte es SELEV
            $empresa_transporte = 'SELEV Pet Industry, S.L.U.';
            $direccion_transporte = 'Autovía A-7 Km. 356';
            $municipio_transporte = 'Silla';
            $cp_transporte = 'ES-46460';
          }
        }
      }

      $punt_rec_actual = PuntoRecogida::where('id', $pto_web_id)->first();
      $cli_prov_punto = $punt_rec_actual->no_prov_cli;

      $productos_ruta = DB::connection(SELEV_BC)->select("
        SELECT
        [No_ ruta]
        ,[No_ linea]
        ,P.[VAT Registration No_] AS CIF
        ,P1.[No_ Autorizac_ Transportista] AS NAutorizacion
        ,P.Address AS Direccionproveedor
        ,P.City AS Municipioproveedor
        ,P.[Post Code] AS Codpostalproveedor
        ,[No_ Proveedor_Cliente]
        ,[Nombre]
        ,[Direccion 1] AS Direccionrecogida
        ,[Direccion 2]
        ,[Poblacion] AS Municipiorecogida
        ,[No_ telefono]
        ,[C_P_] AS Codpostalrecogida
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
        ,L.[Bascula propia]
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
          FROM [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Lin_ ruta diaria$f4e2b823-5811-49c6-a41c-7c9707074208] AS L
          INNER JOIN [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Item-5811-49c6-a41c-7c9707074208] AS T ON T.No_=L.[No_ producto]
          LEFT JOIN [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vendor] AS P ON P.No_=
          (case substring(L.[No_ Proveedor_Cliente],1,1)
          when 'P' then L.[No_ Proveedor_Cliente]
          when 'C' then ('PR'+ substring(L.[No_ Proveedor_Cliente],3,5))
          end)
        LEFT JOIN [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vendor2-5811-49c6-a41c-7c9707074208] as P1 ON P1.No_ =
          (case substring(L.[No_ Proveedor_Cliente],1,1)
          when 'P' then L.[No_ Proveedor_Cliente]
          when 'C' then ('PR'+ substring(L.[No_ Proveedor_Cliente],3,5))
          end)
        WHERE [No_ ruta]='$ruta' and [No_ Proveedor_Cliente] = '$cli_prov_punto'

      ");



      $datos_conductor = DB::connection(SELEV_BC)->table(REMITTEL_Conductores)->where('Cod_ Conductor', $cod_conductor)->get();

      // $prov_empresa_transporte = $datos_conductor[0]->{'Cod_ empresa transporte'};
      // $datos_empresa_transporte = DB::connection(SELEV_BC)->select("select Name, Address, City, [Post Code] FROM [SELEV_BC].[dbo].[SEBOS LEVANTINOS, S_L_$Vendor] WHERE No_ = '$prov_empresa_transporte'");

      // ====================================== DATOS DEL DESTINO ======================================
      $nombre_destino = '';
      $cif_destino = '';
      $num_autorizacion_destino = '';
      $direccion_destino = '';
      $municipio_destino = '';
      $cp_destino = '';


      $tolva_entrada = $productos_ruta[0]->{'Tolva entrada'};

      $lista_tolvas_selev = ['TC-IN-CAM', 'TC-IN-ORGA', 'TC-IN-PS1', 'TC-IN-PS2', 'TC-INTER', 'TC-PA1', 'TC-PA2', 'TC-PESCADO', 'TC-PP1', 'TC-PS1', 'TC-PS2', 'TC-PSH1'];

      $actividad_destino = '';

      if (in_array($tolva_entrada, $lista_tolvas_selev)) {
        $nombre_destino = 'SELEV PET INDUSTRY, S.L.';
        $cif_destino = 'B46062071';
        $num_autorizacion_destino = 'S46230001';
        $direccion_destino = 'AUTOVIA A-7 KM. 356';
        $municipio_destino = 'Silla';
        $cp_destino = 'ES-46460';

        $actividad_destino = 'Planta Transformadora';

      } else {

        $Location = '$Location$f4e2b823';
        $datos_destino = DB::connection(SELEV_BC)->select("
          SELECT *
          FROM [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Location-5811-49c6-a41c-7c9707074208] as L
          LEFT JOIN [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vendor] AS P ON P.No_=L.[Proveedor Asociado]
          LEFT JOIN [SELEV_BC].[dbo].[" . REMITTEL_SQL . "$Vendor2-5811-49c6-a41c-7c9707074208] AS P1 ON P1.No_=L.[Proveedor Asociado]
          WHERE L.Code='$tolva_entrada'
        ");


        if (sizeof($datos_destino) == 1) {

          if ($datos_destino[0]->Actividad == 1) {
            $actividad_destino = 'Planta Intermedia';
          } else if ($datos_destino[0]->Actividad == 2) {
            $actividad_destino = 'Planta Transformadora';
          }


          $nombre_destino = $datos_destino[0]->Name;
          $cif_destino = $datos_destino[0]->{'VAT Registration No_'};
          $num_autorizacion_destino = $datos_destino[0]->{'No_ Autorizac_ Transportista'};
          $direccion_destino = $datos_destino[0]->Address;
          $municipio_destino = $datos_destino[0]->City;
          $cp_destino = $datos_destino[0]->{'Post Code'};
        }
      }
    }

    $vehiculo_ruta = VehiculosRuta::where('cod_ruta', $ruta)->orderby('id', 'desc')->first();
    $productos_punto = ProductosPuntos::where('punto_recogida_id', $pto_web_id)->get();
    $cant_entregados = ProductosAdicionales::where('punto_recogida_id', $pto_web_id)->where('tipo', 'DEJAR')->sum('cantidad');
    $cant_recogidos = ProductosAdicionales::where('punto_recogida_id', $pto_web_id)->where('tipo', 'RECOGER')->sum('cantidad');
    $fechaActual = Carbon::parse($productos_punto[0]->created_at)->locale('es')->translatedFormat('j \d\e F \d\e Y');


    // Aqui guardamos la especie correcta para cada producto
    $datos_ruta_collect = collect($productos_ruta);
    foreach ($productos_punto as $prod) {
      $registro = $datos_ruta_collect->firstWhere('No_ linea', $prod->no_linea);
      $prod->especie = $registro ? $registro->Especie : '';
    }


    // Si la direccion del proveedor no es la misma que la de recogida, en Lugar recobida tendremos ese campo de recogida, sinos el texto del paréntesis.
    $lugar_recogida = $productos_ruta[0]->Direccionproveedor !== $productos_ruta[0]->Direccionrecogida ? $productos_ruta[0]->Direccionrecogida : '(Si no coincide con la dirección)';

    $data = [
      'datos_ruta' => $productos_ruta[0],
      'productos_punto' => $productos_punto,
      'fechaActual' => $fechaActual,
      'cant_entregados' => $cant_entregados,
      'cant_recogidos' => $cant_recogidos,
      'datos_conductor' => $datos_conductor[0],
      'vehiculo_ruta' => $vehiculo_ruta,
      'lugar_recogida' => $lugar_recogida,
      'empresa_transporte' => $empresa_transporte,
      'direccion_transporte' => $direccion_transporte,
      'municipio_transporte' => $municipio_transporte,
      'cp_transporte' => $cp_transporte,
      'nombre_destino' => $nombre_destino,
      'cif_destino' => $cif_destino,
      'num_autorizacion_destino' => $num_autorizacion_destino,
      'direccion_destino' => $direccion_destino,
      'municipio_destino' => $municipio_destino,
      'cp_destino' => $cp_destino,
      'actividad_destino' => $actividad_destino,
      'num_autoriz' => $num_autoriz
    ];

    return PDF::loadView('GSIRSelev.documentos.doc_comercial', $data)->stream('doc_comercial.pdf');
  }
}
