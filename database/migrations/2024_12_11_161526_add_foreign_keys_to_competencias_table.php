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
        Schema::table('competencias', function (Blueprint $table) {
            $table->foreign(['id_curso'], 'competencias_ibfk_1')->references(['id_curso'])->on('cursos')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competencias', function (Blueprint $table) {
            $table->dropForeign('competencias_ibfk_1');
        });
    }
};
