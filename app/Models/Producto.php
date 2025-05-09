<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'idProduct';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'idItemReference',
        'serialNumberProduct',
        'conditionProduct',
        'statusProduct',
        'locationProduct',
        'purchaseDateProduct',
        'warrantyExpirationProduct',
        'notesProduct',
        'createdAtProduct',
        'updatedAtProduct',
    ];

    // Relación con la referencia
    public function reference()
    {
        return $this->belongsTo(Reference::class, 'idItemReference', 'idReference');
    }

    // Acceso indirecto a la categoría (opcional)
    public function category()
    {
        return $this->reference ? $this->reference->category : null;
    }

    public function stockDisponible()
    {
        $entradas = DB::table('entradas')
            ->where('idProducto', $this->idProduct)
            ->sum('cantidad');
        
        $salidas = DB::table('salidas')
            ->where('idProducto', $this->idProduct)
            ->sum('cantidad');
        
        return $entradas - $salidas;
    }
}
