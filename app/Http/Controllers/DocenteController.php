<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// DocenteController.php
class DocenteController extends Controller
{
    public function dashboard()
    {
        return view('docente.dashboard');  // La vista correspondiente para el docente
    }
}