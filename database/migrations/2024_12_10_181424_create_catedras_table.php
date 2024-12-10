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
        Schema::create('catedras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('periodo_id')->index('periodos_periodo_id_foreign');
            $table->unsignedBigInteger('docente_id')->index('docentes_docente_id_foreign');
            $table->unsignedBigInteger('curso_id')->index('cursos_curso_id_foreign');
            $table->unsignedBigInteger('seccion_id')->index('seccions_seccion_id_foreign');

            $table->unique(['curso_id', 'seccion_id'], 'curso_seccion_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catedras');
    }
};
