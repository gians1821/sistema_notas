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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->bigIncrements('id_alumno');
            $table->integer('padre_id')->index('hijos_padre_id_foreign');
            $table->string('profile_photo')->nullable();
            $table->string('periodo', 5);
            $table->string('nombre_alumno', 30);
            $table->string('apellido_alumno', 30);
            $table->date('fecha_nacimiento');
            $table->string('dni', 8);
            $table->string('pais', 30);
            $table->string('region', 30);
            $table->string('ciudad', 30);
            $table->string('distrito', 30);
            $table->string('estado_civil', 15);
            $table->string('telefono', 15);
            $table->unsignedBigInteger('seccion_id_seccion')->index('alumnos_seccion_id_seccion_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
