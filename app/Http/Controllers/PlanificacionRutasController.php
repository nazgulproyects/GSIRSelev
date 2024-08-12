<?php

namespace App\Http\Controllers;

use App\Models\Recogida;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PlanificacionRutasController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        dd('a');
    }
}
