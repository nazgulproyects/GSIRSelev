<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use consultaPageWS;
use consultaWS;


//include_once('C:\xampp\htdocs\GSIR\app\LinkWS\WebServices.php');
include_once(__DIR__ . '/../app/LinkWS/WebServices.php');


class GeneralController extends BaseController
{
  use AuthorizesRequests, ValidatesRequests;

  public function menu_principal()
  {

    $codPedido = 'PV24-0123';
    $fCarga = '';
    $hLlegadaCisterna = '2024-12-05 10:00:00.000';
    $hEntradaCargadero = '10:00';
    $hSalidaCisterna = '2024-12-05 10:00:00.000';
    $hMuestraCisterna = '10:00';
    $hCargaCisterna = '10:00';
    $hSalidaCargadero = '10:00';
    $pesoEntrada = 1;
    $pesoSalida = 1;
    $pesoCargado = 1;
    $pesoMaximo = 1;
    $pesoExtra = 1;
    $cargaMaxima = 1; // coger los m3 del calculo que hago de carga maxima ?
    $m3Cargado = '0'; // ?
    $codProducto = '123';
    $unidadMedida = 'LT'; // bUSCARLA EN LA LIUNEA TABLA ITEM Y PASAR EL "BASE UNIT OF MEASURE"
    $precintos = '123';

    // ========================= GUARDAR DATOS NAVISION (WEB SERVICE) ==========================
    if (iniciaWSlocal()) {
      $consultaWS = new consultaWS('Biocom%20Energ%C3%ADa%2C%20S.L.%20ARRANQUE', 'WSComunicacionWEB', 'http://SRVBC.nuovasesac.es:7347/BIOCOM/WS');
     
      $params = array(
        'codPedido' => $codPedido,
        'fCarga' => $fCarga,
        'fhLlegadaCisterna' => $hLlegadaCisterna,
        'hEntradaCargadero' => $hEntradaCargadero,
        'fhSalidaCisterna' => $hSalidaCisterna,
        'hMuestraCisterna' => $hMuestraCisterna,
        'hCargaCisterna' => $hCargaCisterna,
        'hSalidaCargadero' => $hSalidaCargadero,
        'pesoEntrada' => $pesoEntrada,
        'pesoMaximo' => $pesoMaximo,
        'pesoSalida' => $pesoSalida,
        'pesoExtra' => $pesoExtra,
        'cargaMaxima' => $cargaMaxima,
        'pesoCargado' => $pesoCargado,
        'm3Cargado' => $m3Cargado,
        'precintos' => $precintos,
        'lote' => '123',
        'codProducto' => $codProducto,
        'unidadMedida' => $unidadMedida,
        'cant' => '123',
        'codAlmacen' => '123',
        'codUbicacion' => '123',
        'nContenedor' => '123',
        'precintosA' => '123',
        'presoNeto' => '123',
        'pesoBruto' => '123',
        'vGM' => '123',
        'pesoContenedor' => '123',
        'pesoTara' => '123',
        'tipoCarga' => '123'
      );

      //Ejecutamos funcion concreta de codeunit
      $result = $consultaWS->ProcesoCarga($params);


      //Finalizamos la conexion
      finalizaWS();
    }
    


    // Mostrar por pantalla si hay algun error
    $res = json_decode(json_encode($result), true);
    if (sizeof($res) > 0) dd($res['faultstring']);

    dd($res);

    return view('dashboard');
  }
}
