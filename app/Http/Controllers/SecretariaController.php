<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class SecretariaController extends Controller
{
    public function dashboard()
    {
        return view('secretaria.dashboard');  // La vista correspondiente para la secretaria
    }
}