<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use consultaPageWS;
use consultaWS;


//include_once('C:\xampp\htdocs\GSIR\app\LinkWS\WebServices.php');
include_once(base_path('app/LinkWS/WebServices.php'));

class GeneralController extends BaseController
{
  use AuthorizesRequests, ValidatesRequests;

  public function menu_principal()
  {

    return view('selector_empresa');
  }
}
