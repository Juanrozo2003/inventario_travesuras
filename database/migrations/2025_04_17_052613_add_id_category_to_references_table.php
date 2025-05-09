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
    Schema::table('references', function (Blueprint $table) {
        $table->unsignedBigInteger('idCategory')->after('id')->nullable();

        $table->foreign('idCategory')->references('id')->on('categories')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('references', function (Blueprint $table) {
        $table->dropForeign(['idCategory']);
        $table->dropColumn('idCategory');
    });
}
};
