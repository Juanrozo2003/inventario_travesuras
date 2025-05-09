<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        // Aquí puedes preparar datos para enviar a la vista
        return view('reportes.index');
    }
}
