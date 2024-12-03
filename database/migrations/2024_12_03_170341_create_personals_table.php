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
        Schema::create('personals', function (Blueprint $table) {
            $table->bigIncrements('id_personal');
            $table->string('periodo', 5);
            $table->unsignedBigInteger('id_tipo_personal')->index('personals_id_tipo_personal_foreign');
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->string('dNI', 8);
            $table->string('direccion', 45);
            $table->date('fecha_nacimiento');
            $table->string('telefono', 15);
            $table->unsignedBigInteger('curso_id_curso')->nullable()->index('personals_curso_id_curso_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
