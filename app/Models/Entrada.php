<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Entrada extends Model
{
    use HasFactory;

    protected $table = 'entradas';
    protected $primaryKey = 'id';
    
    public $timestamps = true;

    protected $fillable = [
        'idProducto',
        'cantidad',
        'fechaEntrada',
        'motivo',
        'observaciones',
    ];

    // esto para convertir automáticamente las fechas
    protected $casts = [
        'fechaEntrada' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto', 'idProduct');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function($entrada) {
            // Actualizar el estado del producto
            DB::table('products')
                ->where('idProduct', $entrada->idProducto)
                ->update([
                    'statusProduct' => 'available',
                    'updatedAtProduct' => now()
                ]);
            
            // Registrar movimiento de inventario
            DB::table('movements')->insert([
                'idProduct' => $entrada->idProducto,
                'idUser' => Auth::id() ?? 1,
                'idMovementType' => DB::table('movement_types')
                                    ->where('nameMovementType', 'Entrada')
                                    ->value('idMovementType'),
                'quantityMovement' => $entrada->cantidad,
                'dateMovement' => now(),
                'reasonMovement' => 'Entrada registrada: ' . $entrada->motivo,
                'createdAtMovement' => now(),
                'updatedAtMovement' => now()
            ]);

            // Registrar auditoría usando el modelo AuditLog
            if (class_exists('App\Models\AuditLog')) {
                AuditLog::create([
                    'user_id' => Auth::id() ?? 1,
                    'model_type' => 'Entrada',
                    'model_id' => $entrada->id,
                    'action' => 'create',
                    'new_values' => $entrada->toArray(),
                    'ip_address' => request()->ip(),
                    'created_at' => now()
                ]);
            }
        });

        static::updated(function($entrada) {
            if (class_exists('App\Models\AuditLog')) {
                AuditLog::create([
                    'user_id' => Auth::id() ?? 1,
                    'model_type' => 'Entrada',
                    'model_id' => $entrada->id,
                    'action' => 'update',
                    'old_values' => $entrada->getOriginal(),
                    'new_values' => $entrada->getChanges(),
                    'ip_address' => request()->ip(),
                    'created_at' => now()
                ]);
            }
        });

        static::deleted(function($entrada) {
            if (class_exists('App\Models\AuditLog')) {
                AuditLog::create([
                    'user_id' => Auth::id() ?? 1,
                    'model_type' => 'Entrada',
                    'model_id' => $entrada->id,
                    'action' => 'delete',
                    'old_values' => $entrada->toArray(),
                    'ip_address' => request()->ip(),
                    'created_at' => now()
                ]);
            }
            
            // Registrar movimiento de eliminación
            DB::table('movements')->insert([
                'idProduct' => $entrada->idProducto,
                'idUser' => Auth::id() ?? 1,
                'idMovementType' => DB::table('movement_types')
                                    ->where('nameMovementType', 'Salida')
                                    ->value('idMovementType'),
                'quantityMovement' => $entrada->cantidad,
                'dateMovement' => now(),
                'reasonMovement' => 'Entrada eliminada: ' . $entrada->motivo,
                'createdAtMovement' => now(),
                'updatedAtMovement' => now()
            ]);
        });
    }
}