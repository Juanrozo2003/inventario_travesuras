<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
// database/migrations/[timestamp]_update_references_table.php


return new class extends Migration
{
    public function up()
    {
        // Paso 1: Verificar y eliminar tablas temporales si existen
        if (Schema::hasTable('old_references')) {
            Schema::drop('old_references');
        }

        // Paso 2: Verificar si la tabla references existe
        if (Schema::hasTable('references')) {
            // Paso 3: Crear backup de los datos existentes
            $this->backupReferencesData();
            
            // Paso 4: Renombrar la tabla original
            Schema::rename('references', 'old_references');
        }

        // Paso 5: Crear nueva estructura
        Schema::create('references', function (Blueprint $table) {
            $table->bigIncrements('idReference');
            $table->unsignedBigInteger('idCategory');
            $table->string('codeReference', 50)->unique();
            $table->string('nameReference');
            $table->text('descriptionReference')->nullable();
            $table->json('specificationsReference')->nullable();
            $table->integer('minStockReference')->default(1);
            $table->integer('maxStockReference')->nullable();
            $table->timestamps();
            
            $table->foreign('idCategory')->references('idCategory')->on('categories');
        });

        // Paso 6: Migrar datos desde el backup
        $this->restoreReferencesData();
    }

    public function down()
    {
        // Revertir los cambios si es necesario
        Schema::dropIfExists('references');
        if (Schema::hasTable('old_references')) {
            Schema::rename('old_references', 'references');
        }
    }

    /**
     * Backup de datos existentes
     */
    private function backupReferencesData()
    {
        if (!Schema::hasTable('backup_references_data')) {
            Schema::create('backup_references_data', function (Blueprint $table) {
                $table->id();
                $table->json('original_data');
                $table->timestamps();
            });
        }

        $data = DB::table('references')->get()->toJson();
        DB::table('backup_references_data')->insert(['original_data' => $data]);
    }

    /**
     * Restaurar datos desde el backup
     */
    private function restoreReferencesData()
    {
        if (Schema::hasTable('old_references')) {
            $columns = [
                'idCategory', 'codeReference', 'nameReference', 
                'descriptionReference', 'specificationsReference',
                'minStockReference', 'maxStockReference',
                'created_at', 'updated_at'
            ];
            
            DB::table('references')->insertUsing(
                $columns,
                DB::table('old_references')
                    ->select(
                        DB::raw('1 as idCategory'), // Valor por defecto para idCategory
                        DB::raw('CONCAT("REF-", id) as codeReference'),
                        DB::raw('"Nombre de referencia" as nameReference'),
                        DB::raw('NULL as descriptionReference'),
                        DB::raw('NULL as specificationsReference'),
                        DB::raw('1 as minStockReference'),
                        DB::raw('NULL as maxStockReference'),
                        'created_at',
                        'updated_at'
                    )
            );
            
            // Eliminar tabla temporal después de migrar
            Schema::dropIfExists('old_references');
        }
        
        // Eliminar tabla de backup
        Schema::dropIfExists('backup_references_data');
    }
};