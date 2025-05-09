<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\RectoraController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\ContadorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\AlertaController;


// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

Route::get('/academico', function () {
    return view('pages.academico.index');
})->name('academico');

Route::get('/admisiones', function () {
    return view('pages.admisiones.index');
})->name('admisiones');

Route::get('/nosotros', function () {
    return view('pages.nosotros.index');
})->name('nosotros');

Route::get('/contactanos', function () {
    return view('pages.contacto.contacto');
})->name('contactanos');

// Autenticación (registro desactivado)
Auth::routes(['register' => false]);

// Redirección inteligente según el rol
Route::get('/redirect-dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    switch ($user->rol) {
        case 'rectora':
            return redirect()->route('rectora.dashboard');
        case 'docente':
            return redirect()->route('docente.dashboard');
        case 'secretaria':
            return redirect()->route('secretaria.dashboard');
        case 'contador':
            return redirect()->route('contador.dashboard');
        default:
            abort(403, 'Rol no autorizado.');
    }
})->name('redirect.dashboard')->middleware('auth');

// Rutas protegidas (requieren login)
Route::middleware(['auth'])->group(function () {

    // Dashboards por rol
    Route::get('/rectora/dashboard', [RectoraController::class, 'dashboard'])->name('rectora.dashboard');
    Route::get('/docente/dashboard', [DocenteController::class, 'dashboard'])->name('docente.dashboard');
    Route::get('/secretaria/dashboard', [SecretariaController::class, 'dashboard'])->name('secretaria.dashboard');
    Route::get('/contador/dashboard', [ContadorController::class, 'dashboard'])->name('contador.dashboard');

    // Gestión de productos e inventario
    Route::resource('productos', ProductoController::class);
    Route::post('/productos/import', [ProductoController::class, 'import'])->name('productos.import');


    Route::resource('references', ReferenceController::class);

    Route::resource('entradas', EntradaController::class)->parameters([
        'entradas' => 'entrada'
    ]);
    Route::resource('salidas', SalidaController::class);
    Route::resource('historial', HistorialController::class)->only(['index']);

    // Movimientos
    Route::prefix('movements')->group(function () {
        Route::get('/', [MovementController::class, 'index'])->name('movements.index');
        Route::get('/filter', [MovementController::class, 'filter'])->name('movements.filter');
        Route::post('/{movement}/reverse', [MovementController::class, 'reverse'])->name('movements.reverse');
    });
    Route::resource('movements', MovementController::class);

    // Categorías
    Route::resource('categories', CategoryController::class);

    // Gestión de usuarios
    Route::resource('usuarios', UserController::class);
    Route::get('usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::resource('usuarios', UserController::class);

    Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');

    Route::get('/alertas', [AlertaController::class, 'index'])->name('alertas.index');

    // Registro de movimientos desde productos
    Route::post('/products/{product}/register-movement', [ProductController::class, 'registerMovement'])
        ->name('products.register-movement');
});
