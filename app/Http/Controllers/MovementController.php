<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use App\Models\Producto;
use App\Models\User;
use App\Models\MovementType;

class MovementController extends Controller
{
    public function index()
    {
        $movements = Movement::with(['product', 'user', 'movementType'])->orderByDesc('dateMovement')->get();
        return view('movements.index', compact('movements'));
    }

    public function create()
    {
        $products = Producto::all();
        $movementTypes = MovementType::all();
        return view('movements.create', compact('products', 'movementTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idProduct' => 'required|exists:productos,idProduct',
            'idMovementType' => 'required|exists:movement_types,idMovementType',
            'quantityMovement' => 'required|integer',
            'dateMovement' => 'required|date',
            'reasonMovement' => 'nullable|string',
            'documentNumberMovement' => 'nullable|string',
            'notesMovement' => 'nullable|string',
        ]);

        Movement::create([
            'idProduct' => $request->idProduct,
            'idMovementType' => $request->idMovementType,
            'idUser' => auth()->id(),
            'quantityMovement' => $request->quantityMovement,
            'dateMovement' => $request->dateMovement,
            'reasonMovement' => $request->reasonMovement,
            'documentNumberMovement' => $request->documentNumberMovement,
            'notesMovement' => $request->notesMovement,
            'createdAtMovement' => now(),
            'updatedAtMovement' => now(),
        ]);

        return redirect()->route('movements.index')->with('success', 'Movimiento registrado correctamente.');
    }
}
