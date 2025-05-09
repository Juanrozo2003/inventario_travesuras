<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function redirectByRole()
    {
        $user = Auth::user();

        if ($user->isRectora()) {
            return view('dashboard.rectora');
        } elseif ($user->isSecretaria()) {
            return view('dashboard.secretaria');
        } elseif ($user->isContador()) {
            return view('dashboard.contador');
        } elseif ($user->isDocente()) {
            return view('dashboard.docente');
        } elseif ($user->isContador()) {
            return view('dashboard.contador');
        } else {
            abort(403, 'Acceso no autorizado');
        }
    }

    public function admin()
    {
        return view('admin.dashboard'); // Vista para el dashboard del admin
    }

    public function docente()
    {
        return view('docente.dashboard'); // Vista para el dashboard del docente
    }

    public function secretaria()
    {
        return view('secretaria.dashboard'); // Vista para el dashboard de la secretaria
    }

    public function contador()
    {
        return view('contador.dashboard'); // Vista para el dashboard del contador
    }

    public function estudiante()
    {
        return view('estudiante.dashboard'); // Vista para el dashboard del estudiante
    }
}
