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
        Schema::table('seccions', function (Blueprint $table) {
            $table->foreign(['grado_id_grado'], 'seccions_ibfk_1')->references(['id_grado'])->on('grados')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seccions', function (Blueprint $table) {
            $table->dropForeign('seccions_ibfk_1');
        });
    }
};
