<?php

namespace App\Http\Controllers;

use App\Models\PendientesDescarga;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//use consultaPageWS;
//use consultaWS;


//include_once('C:\xampp\htdocs\GSIR\app\LinkWS\WebServices.php');
//include_once(base_path('app/LinkWS/WebServices.php'));

class GeneralController extends BaseController
{
  use AuthorizesRequests, ValidatesRequests;

  public function menu_principal()
  {
    $num_desc_pend = PendientesDescarga::where('estado', 'PENDIENTE')->count();

    return view('GSIRSelev.principal')->with(compact('num_desc_pend'));
    //return view('selector_empresa');
  }
}
