<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Asumiendo que el modelo Producto representa el inventario

class AlertaController extends Controller
{
    public function index()
    {
        // Se obtienen productos cuyo stock esté por debajo del mínimo permitido
        $productosConBajoStock = Producto::whereColumn('stock', '<', 'stock_minimo')->get();

        return view('alertas.index', compact('productosConBajoStock'));
    }
}
