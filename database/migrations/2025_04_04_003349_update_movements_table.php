<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('movements', 'old_movements');
        
        Schema::create('movements', function (Blueprint $table) {
            $table->bigIncrements('idMovement');
            $table->unsignedBigInteger('idProduct');
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idMovementType');
            $table->integer('quantityMovement')->default(1);
            $table->dateTime('dateMovement');
            $table->string('reasonMovement');
            $table->string('documentNumberMovement', 100)->nullable();
            $table->text('notesMovement')->nullable();
            $table->timestamps();
            
            $table->foreign('idProduct')->references('idProduct')->on('products');
            $table->foreign('idUser')->references('idUser')->on('users');
            $table->foreign('idMovementType')->references('idMovementType')->on('movement_types');
        });

        // Si hay datos existentes, migrarlos
        DB::statement("
            INSERT INTO movements (idMovement, idProduct, idUser, idMovementType, dateMovement, createdAtMovement, updatedAtMovement)
            SELECT id, 1, 1, 1, NOW(), created_at, updated_at 
            FROM old_movements
        ");
        
        Schema::dropIfExists('old_movements');
    }

    public function down()
    {
        Schema::rename('movements', 'new_movements');
        
        Schema::create('movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });
        
        Schema::dropIfExists('new_movements');
    }
};