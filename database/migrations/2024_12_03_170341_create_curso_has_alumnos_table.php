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
        Schema::create('curso_has_alumnos', function (Blueprint $table) {
            $table->unsignedBigInteger('curso_id_curso')->index('curso_has_alumnos_curso_id_curso_foreign');
            $table->unsignedBigInteger('alumno_id_alumno')->index('curso_has_alumnos_alumno_id_alumno_foreign');
            $table->string('nota1', 45)->nullable();
            $table->string('nota2', 45)->nullable();
            $table->string('nota3', 45)->nullable();
            $table->string('visibilidad', 15)->default('docente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_has_alumnos');
    }
};
