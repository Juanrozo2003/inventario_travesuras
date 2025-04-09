<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function academico()
    {
        return view('academico.academico');
    }

    public function admisiones()
    {
        return view('admisiones.admisiones');
    }

    public function nosotros()
    {
        return view('nosotros.nosotros');
    }

    public function contactanos()
    {
        return view('contactanos.contactanos');
    }
}