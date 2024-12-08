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
        Schema::table('notas', function (Blueprint $table) {
            $table->foreign(['alumno_id_alumno'], 'notas_ibfk_2')->references(['id_alumno'])->on('alumnos')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['catedra_id'], 'notas_ibfk_3')->references(['id'])->on('catedras')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['competencia_id'], 'notas_ibfk_4')->references(['id_competencia'])->on('competencias')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notas', function (Blueprint $table) {
            $table->dropForeign('notas_ibfk_2');
            $table->dropForeign('notas_ibfk_3');
            $table->dropForeign('notas_ibfk_4');
        });
    }
};
