<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Salida extends Model
{
   
    protected $table = 'salidas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'idProducto',
        'cantidad',
        'fechaSalida',
        'motivo',
        'observaciones',
    ];

     // En app/Models/Salida.php
     // esto para convertir automáticamente las fechas
     protected $casts = [
        'fechaSalida' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($salida) {
            // Validar stock disponible antes de crear la salida
            $producto = Producto::find($salida->idProducto);
            if ($producto && $producto->statusProduct !== 'available') {
                throw new \Exception("El producto no está disponible para salida");
            }
        });

        static::created(function($salida) {
            // Registrar movimiento de inventario
            DB::table('movements')->insert([
                'idProduct' => $salida->idProducto,
                'idUser' => Auth::id() ?? 1,
                'idMovementType' => DB::table('movement_types')
                                    ->where('nameMovementType', 'Salida')
                                    ->value('idMovementType'),
                'quantityMovement' => $salida->cantidad,
                'dateMovement' => now(),
                'reasonMovement' => 'Salida registrada: ' . $salida->motivo,
                'createdAtMovement' => now(),
                'updatedAtMovement' => now()
            ]);

            // Registrar auditoría
            if (class_exists('App\Models\AuditLog')) {
                AuditLog::create([
                    'user_id' => Auth::id() ?? 1,
                    'model_type' => 'Salida',
                    'model_id' => $salida->id,
                    'action' => 'create',
                    'new_values' => $salida->toArray(),
                    'ip_address' => request()->ip(),
                    'created_at' => now()
                ]);
            }
        });

        static::updated(function($salida) {
            if (class_exists('App\Models\AuditLog')) {
                AuditLog::create([
                    'user_id' => Auth::id() ?? 1,
                    'model_type' => 'Salida',
                    'model_id' => $salida->id,
                    'action' => 'update',
                    'old_values' => $salida->getOriginal(),
                    'new_values' => $salida->getChanges(),
                    'ip_address' => request()->ip(),
                    'created_at' => now()
                ]);
            }
        });

        static::deleted(function($salida) {
            // Registrar movimiento de reverso
            DB::table('movements')->insert([
                'idProduct' => $salida->idProducto,
                'idUser' => Auth::id() ?? 1,
                'idMovementType' => DB::table('movement_types')
                                    ->where('nameMovementType', 'Entrada')
                                    ->value('idMovementType'),
                'quantityMovement' => $salida->cantidad,
                'dateMovement' => now(),
                'reasonMovement' => 'Salida eliminada: ' . $salida->motivo,
                'createdAtMovement' => now(),
                'updatedAtMovement' => now()
            ]);

            if (class_exists('App\Models\AuditLog')) {
                AuditLog::create([
                    'user_id' => Auth::id() ?? 1,
                    'model_type' => 'Salida',
                    'model_id' => $salida->id,
                    'action' => 'delete',
                    'old_values' => $salida->toArray(),
                    'ip_address' => request()->ip(),
                    'created_at' => now()
                ]);
            }
        });
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }
}