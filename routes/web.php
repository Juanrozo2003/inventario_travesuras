<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RectoraController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\ContadorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;

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

    // Rutas protegidas (requieren login)
    Route::middleware(['auth'])->group(function () {
    // Ruta por defecto si alguien accede a /home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Dashboards por rol
    Route::get('/rectora/dashboard', [RectoraController::class, 'dashboard'])->name('rectora.dashboard');
    Route::get('/docente/dashboard', [DocenteController::class, 'dashboard'])->name('docente.dashboard');
    Route::get('/secretaria/dashboard', [SecretariaController::class, 'dashboard'])->name('secretaria.dashboard');
    Route::get('/contador/dashboard', [ContadorController::class, 'dashboard'])->name('contador.dashboard');


    // Inventario - CRUD
    Route::resource('references', ReferenceController::class)->except(['show']);
    Route::resource('products', ProductController::class);

    // Movimientos
    Route::prefix('movements')->group(function () {
        Route::get('/', [MovementController::class, 'index'])->name('movements.index');
        Route::get('/filter', [MovementController::class, 'filter'])->name('movements.filter');
        Route::post('/{movement}/reverse', [MovementController::class, 'reverse'])->name('movements.reverse');
    });
    Route::middleware(['auth'])->group(function () {
        Route::resource('usuarios', UserController::class);
    });

    Route::get('usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('usuarios', [UserController::class, 'store'])->name('usuarios.store');
    
    Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');


    // Registro de movimientos desde productos
    Route::post('/products/{product}/register-movement', [ProductController::class, 'registerMovement'])
        ->name('products.register-movement');
});
