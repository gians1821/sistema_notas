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
            $table->id('CodLibro'); // Definir la clave primaria
            $table->string('TitLibro', 40);
            $table->char('AnoLibro', 4);
            $table->unsignedBigInteger('IdAutor');
            $table->char('IdEditorial', 2);
            $table->integer('Cantidad');

            // Definir claves foráneas
            $table->foreign('IdAutor')->references('IdAutor')->on('autores')->onDelete('cascade');
            $table->foreign('IdEditorial')->references('IdEditorial')->on('editoriales')->onDelete('cascade');

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
