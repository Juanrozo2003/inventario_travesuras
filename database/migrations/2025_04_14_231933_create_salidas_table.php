<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->id('idSalida');
            $table->unsignedBigInteger('idProducto');
            $table->integer('cantidad');
            $table->date('fechaSalida');
            $table->string('motivo');
            $table->text('observaciones')->nullable();
            $table->timestamps();
    
            $table->foreign('idProducto')->references('idProduct')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salidas');
    }
};
