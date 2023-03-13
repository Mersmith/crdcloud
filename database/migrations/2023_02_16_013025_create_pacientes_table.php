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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->unique()->constrained('users');
            //$table->foreignId('sede_id')->constrained('sedes');

            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('dni')->nullable();
            $table->string('email');
            $table->string('celular')->nullable();
            $table->enum('genero', ['hombre', 'mujer']);
            $table->string('rol')->nullable()->default("paciente");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
