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
        Schema::create('direccions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('distrito_id');

            $table->string('direccion')->nullable();
            $table->string('referencia')->nullable();
            $table->string('departamento_nombre');
            $table->string('provincia_nombre');
            $table->string('distrito_nombre');
            $table->string('codigo_postal')->nullable();
            //$table->integer('posicion')->default(1);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('distrito_id')->references('id')->on('distritos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direccions');
    }
};
