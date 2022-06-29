<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->unsignedInteger('id_cliente')->nullable();
            $table->integer('casillero')->nullable();
            $table->integer('gaveta')->nullable();
            $table->string('od_esf',20)->nullable();
            $table->string('od_cyl',20)->nullable();
            $table->string('od_eje',20)->nullable();
            $table->string('od_add',20)->nullable();
            $table->string('od_dp',20)->nullable();
            $table->string('od_af',20)->nullable();
            $table->string('oi_esf',20)->nullable();
            $table->string('oi_cyl',20)->nullable();
            $table->string('oi_eje',20)->nullable();
            $table->string('oi_add',20)->nullable();
            $table->string('oi_dp',20)->nullable();
            $table->string('oi_af',20)->nullable();
            $table->string('medidas_especiales',50)->nullable();
            $table->string('tipo_lente',50)->nullable();
            $table->integer('valor_lente')->nullable();
            $table->integer('comision_lente')->nullable();
            $table->string('filtros_adicionales',50)->nullable();
            $table->unsignedInteger('id_laboratorio')->nullable();
            $table->unsignedInteger('id_laboratorio_bisel')->nullable();
            $table->string('montura',50)->nullable();
            $table->string('color',50)->nullable();
            $table->integer('valor_montura')->nullable();
            $table->integer('comision_montura')->nullable();
            $table->unsignedInteger('id_vendedor')->nullable();
            $table->unsignedInteger('id_estado')->nullable();
            $table->unsignedInteger('id_estado_venta')->nullable();
            $table->string('observaciones',200)->nullable();
            $table->foreign('id_cliente')->references('id')->on('usuarios');
            $table->foreign('id_vendedor')->references('id')->on('usuarios');
            $table->foreign('id_laboratorio')->references('id')->on('laboratorios');
            $table->foreign('id_laboratorio_bisel')->references('id')->on('laboratorios');
            $table->foreign('id_estado_venta')->references('id')->on('estado_ventas');
            $table->foreign('id_estado')->references('id')->on('estados');
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
        Schema::dropIfExists('solicitud_ventas');
    }
}
