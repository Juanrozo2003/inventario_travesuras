<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class RectoraController extends Controller
{
    public function dashboard()
    {
        return view('rectora.dashboard');  // La vista correspondiente para la rectora
    }
}