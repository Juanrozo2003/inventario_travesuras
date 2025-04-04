<?php
// database/migrations/[timestamp]_update_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Primero renombrar la tabla temporalmente
        Schema::rename('users', 'old_users');
        
        // Crear nueva tabla users con la estructura deseada
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('roleUser', ['admin','user','secretary','accountant','teacher'])->default('user');
            $table->enum('statusUser', ['active','inactive','suspended'])->default('active');
            $table->dateTime('lastLoginUser')->nullable();
            $table->string('rememberTokenUser', 100)->nullable();
            $table->timestamps();
        });

        // Migrar los datos
        DB::statement("
            INSERT INTO users (id, name, email, password, rememberToken, createdAt, updatedAt)
            SELECT id, name, email, password, remember_token, created_at, updated_at 
            FROM old_users
        ");
        
        // Actualizar roles para usuarios existentes
        DB::table('users')->where('email', 'admin@colegio.com')->update(['role' => 'admin']);
        
        // Eliminar tabla temporal
        Schema::dropIfExists('old_users');
    }

    public function down()
    {
        // Revertir los cambios si es necesario
        Schema::rename('users', 'new_users');
        
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        DB::statement("
            INSERT INTO users (id, name, email, password, remember_token, created_at, updated_at)
            SELECT id, name, email, password, rememberToken, createdAt, updatedAt 
            FROM new_users
        ");
        
        Schema::dropIfExists('new_users');
    }
};