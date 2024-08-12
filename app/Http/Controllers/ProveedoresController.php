<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ProveedoresController extends BaseController
{
  use AuthorizesRequests, ValidatesRequests;

  public function index()
  {
    $proveedores = Proveedores::all();

    return view('proveedores.index')->with(compact('proveedores'));
  }

}
