<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class GeneralController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function menu_principal(){
        return view('auth.register');
    }
}
