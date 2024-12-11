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
        Schema::table('catedras', function (Blueprint $table) {
            $table->foreign(['periodo_id'], 'catedras_ibfk_1')->references(['id'])->on('periodos')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['docente_id'], 'catedras_ibfk_2')->references(['id_personal'])->on('personals')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['curso_id'], 'catedras_ibfk_3')->references(['id_curso'])->on('cursos')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['seccion_id'], 'catedras_ibfk_4')->references(['id_seccion'])->on('seccions')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catedras', function (Blueprint $table) {
            $table->dropForeign('catedras_ibfk_1');
            $table->dropForeign('catedras_ibfk_2');
            $table->dropForeign('catedras_ibfk_3');
            $table->dropForeign('catedras_ibfk_4');
        });
    }
};
