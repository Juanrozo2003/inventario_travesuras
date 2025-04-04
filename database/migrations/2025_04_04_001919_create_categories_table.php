<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

// database/migrations/[timestamp]_create_categories_table.php

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('idCategory');
            $table->string('nameCategory')->unique();
            $table->text('descriptionCategory')->nullable();
            $table->timestamps();
        });

        // Datos iniciales
        DB::table('categories')->insert([
            ['nameCategory' => 'Tecnología', 'descriptionCategory' => 'Equipos electrónicos y tecnológicos'],
            ['nameCategory' => 'Libros', 'descriptionCategory' => 'Material bibliográfico'],
            ['nameCategory' => 'Mobiliario', 'descriptionCategory' => 'Muebles y equipamiento'],
            ['nameCategory' => 'Materiales', 'descriptionCategory' => 'Suministros y materiales educativos'],
            ['nameCategory' => 'Otros', 'descriptionCategory' => 'Otros elementos del inventario']
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};