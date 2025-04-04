<?php

// database/migrations/[timestamp]_create_assignments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('idAssignment');
            $table->unsignedBigInteger('idProduct');
            $table->unsignedBigInteger('idUserAssigned');
            $table->unsignedBigInteger('idUserAssigner');
            $table->date('dateAssigned');
            $table->date('expectedReturnAssignment')->nullable();
            $table->date('dateReturnedAssignment')->nullable();
            $table->enum('statusAssignment', ['active','returned','lost','extended'])->default('active');
            $table->text('notesAssignment')->nullable();
            $table->timestamps();
            
            $table->foreign('idProduct')->references('idProduct')->on('products');
            $table->foreign('idUserAssigned')->references('idUser')->on('users');
            $table->foreign('idUserAssigner')->references('idUser')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};