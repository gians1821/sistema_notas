<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id('CodLibro');
            $table->string('TitLibro', 40);
            $table->char('AnoLibro', 4);
            
            /* Relación #1 con otra tabla */
            $table->unsignedBigInteger('IdAutor');
            $table->foreign('IdAutor')->references('IdAutor')->on('autores')->onDelete('cascade');

            /* Relación #2 con otra tabla */
            $table->char('IdEditorial', 2);
            $table->foreign('IdEditorial')->references('IdEditorial')->on('editoriales')->onDelete('cascade');

            $table->integer('Cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
