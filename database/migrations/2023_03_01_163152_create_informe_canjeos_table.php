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
        Schema::create('informe_canjeos', function (Blueprint $table) {
            $table->id();

            $table->string('informe_canjeo_ruta');
            $table->unsignedBigInteger('informe_canjeoable_id');
            $table->string('informe_canjeoable_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informe_canjeos');
    }
};
