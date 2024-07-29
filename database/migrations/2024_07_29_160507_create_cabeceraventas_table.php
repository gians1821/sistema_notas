<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabeceraventasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabeceraventas', function (Blueprint $table) {
            $table->bigIncrements('venta_id')->id();
            $table->bigInteger('cliente_id');
            $table->date('fecha_venta');
            $table->bigInteger('tipo_id');
            $table->string('nrodoc', 12);
            $table->float('total');
            $table->float('subtotal');
            $table->float('igv');
            $table->tinyInteger('estado');
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
        Schema::dropIfExists('cabeceraventas');
    }
}
