<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ContadorController.php
class ContadorController extends Controller
{
    public function dashboard()
    {
        return view('contador.dashboard');  // La vista correspondiente para el contador
    }
}