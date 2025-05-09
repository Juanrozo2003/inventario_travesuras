<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'idCategory'; // Suponiendo que este es el nombre real de tu clave primaria
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nameCategory',
        'descriptionCategory',
        'createdAtCategory',
        'updatedAtCategory',
    ];

    public function references()
    {
        return $this->hasMany(Reference::class, 'idCategory', 'idCategory');
    }
}
