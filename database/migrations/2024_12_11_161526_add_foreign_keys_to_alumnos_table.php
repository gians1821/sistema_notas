<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alumnos', function (Blueprint $table) {
            $table->foreign(['padre_id'], 'alumnos_ibfk_1')->references(['id'])->on('padres')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['seccion_id_seccion'], 'alumnos_ibfk_2')->references(['id_seccion'])->on('seccions')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumnos', function (Blueprint $table) {
            $table->dropForeign('alumnos_ibfk_1');
            $table->dropForeign('alumnos_ibfk_2');
        });
    }
};
