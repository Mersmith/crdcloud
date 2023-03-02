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
        Schema::create('canjeo_detalles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('canjeo_id');
            $table->unsignedBigInteger('servicio_id');

            $table->integer('cantidad');
            $table->float('puntos');

            $table->foreign('canjeo_id')->references('id')->on('canjeos')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canjeo_detalles');
    }
};
