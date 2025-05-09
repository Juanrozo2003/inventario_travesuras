<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reference extends Model
{
    use HasFactory;

    protected $table = 'items_references';
    protected $primaryKey = 'idReference';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'idCategory',
        'codeReference',
        'nameReference',
        'descriptionReference',
        'specificationsReference',
        'minStockReference',
        'maxStockReference',
        'createdAtReference',
        'updatedAtReference',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'idCategory', 'idCategory');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idItemReference', 'idReference');
    }
}
