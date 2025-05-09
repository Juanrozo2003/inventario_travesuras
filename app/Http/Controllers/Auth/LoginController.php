<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirección por defecto (no se usa si está `authenticated()`).
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirige automáticamente según el rol del usuario después del login.
     */
    protected function authenticated(Request $request, $user)
    {
        switch ($user->rol) {
            case 'rectora':
                return redirect()->route('rectora.dashboard');
            case 'secretaria':
                return redirect()->route('secretaria.dashboard');
            case 'contador':
                return redirect()->route('contador.dashboard');
            case 'docente':
                return redirect()->route('docente.dashboard');
            case 'contador':
                    return redirect()->route('contador.dashboard');
            default:
                Auth::logout();
                return redirect('/login')->withErrors(['rol' => 'Rol no reconocido.']);
        }
    }

   /**
     * Redirige al cerrar sesión.
     */
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}