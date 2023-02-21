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
        Schema::create('clinicas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->unique()->constrained('users');
            $table->unsignedBigInteger('especialidad_id');
            $table->foreignId('sede_id')->constrained('sedes');

            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('email')->unique();
            $table->string('celular')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['hombre', 'mujer']);
            $table->integer('puntos')->nullable()->default(0);
            $table->string('ruc')->nullable()->unique();
            $table->string('nombre_clinica')->nullable()->unique();
            $table->string('rol')->nullable()->default("clinica");

            $table->foreign('especialidad_id')->references('id')->on('especialidads');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinicas');
    }
};
