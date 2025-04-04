<?php
// database/migrations/[timestamp]_create_movement_types_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movement_types', function (Blueprint $table) {
            $table->bigIncrements('idMovementType');
            $table->string('nameMovementType')->unique();
            $table->text('descriptionMovementType')->nullable();
            $table->boolean('affectsStockMovementType')->default(true);
            $table->timestamps();
        });

        // Tipos de movimiento básicos
        DB::table('movement_types')->insert([
            ['nameMovementType' => 'Entrada', 'descriptionMovementType' => 'Ingreso de productos al inventario', 'affectsStockMovementType' => 1],
            ['nameMovementType' => 'Salida', 'descriptionMovementType' => 'Egreso de productos del inventario', 'affectsStockMovementType' => 1],
            ['nameMovementType' => 'Transferencia', 'descriptionMovementType' => 'Movimiento entre ubicaciones', 'affectsStockMovementType' => 0],
            ['nameMovementType' => 'Ajuste', 'descriptionMovementType' => 'Ajuste de inventario', 'affectsStockMovementType' => 1],
            ['nameMovementType' => 'Préstamo', 'descriptionMovementType' => 'Préstamo temporal de producto', 'affectsStockMovementType' => 0]
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('movement_types');
    }
};