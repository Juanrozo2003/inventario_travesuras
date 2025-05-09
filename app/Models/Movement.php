<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movement extends Model
{
    use HasFactory;

    protected $table = 'movements';
    protected $primaryKey = 'idMovement';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'idProduct',
        'idUser',
        'idMovementType',
        'quantityMovement',
        'dateMovement',
        'reasonMovement',
        'documentNumberMovement',
        'notesMovement',
        'createdAtMovement',
        'updatedAtMovement',
    ];

    public function product()
    {
        return $this->belongsTo(Producto::class, 'idProduct', 'idProduct');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

    public function movementType()
    {
        return $this->belongsTo(MovementType::class, 'idMovementType', 'idMovementType');
    }
}
